import { defineStore } from 'pinia';
import {ref} from 'vue';
import cultureData from '@/data/culture'
import { userStore } from './userStore';

export const cultureStore = defineStore('culture',() => {
    const currentUser = userStore();
    const data = ref(structuredClone(cultureData));
    const getDataById = (id: number) => {
        return data.value.find((culture) => culture.id === id);
    };
    const addComment = (cultureId: number,comment: string) => {
        const culture = data.value.find((culture) => culture.id === cultureId);

        if(!culture){
            return;
        }

        
        culture.comment.unshift({
            id: culture.comment.length,
            comment,
            user: currentUser.user,
            reply: [],
            created_date: new Date()
        });

    }

    return {data,getDataById,addComment};
});