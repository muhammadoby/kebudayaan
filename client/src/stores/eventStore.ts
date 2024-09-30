import { defineStore } from 'pinia';
import {ref} from 'vue';
import eventData from '@/data/event';
import { userStore } from './userStore';
export const eventStore = defineStore('event',() => {
    const currentUser = userStore();
    const data = ref(structuredClone(eventData));
    const getDataById = (id: number) => {
        return data.value.find((event) => event.id === id);
    };
    const addComment = (cultureId: number,comment: string) => {
        const event = data.value.find((culture) => culture.id === cultureId);

        if(!event){
            return;
        }

        event.comment.unshift({
            id: event.comment.length,
            comment,
            user: currentUser.user,
            reply: [],
            created_date: new Date()
        });
    }
    return {data,getDataById,addComment};
});