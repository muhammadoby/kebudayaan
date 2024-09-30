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

    const addReply = (cultureId: number,commentId: number,reply: string) => {
        const culture = data.value.find((culture) => culture.id === cultureId);
        const comment = culture?.comment.find((comment) => {comment.id === commentId});

        comment?.reply.push({
            user: currentUser.user,
            comment: reply,
            created_date: new Date()
        });
    }

    const getReply = (cultureId: number,commentId: number) => {
        const culture = data.value.find((culture) => culture.id === cultureId);
        const comment = culture?.comment.find((comment) => {comment.id === commentId});

        return comment?.reply;
    }
    return {data,getDataById,addComment,addReply,getReply};
});