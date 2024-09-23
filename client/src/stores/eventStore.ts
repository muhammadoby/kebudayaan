import { defineStore } from 'pinia';
import {ref} from 'vue';
import eventData from '@/data/event';
export const eventStore = defineStore('event',() => {
    const data = ref(structuredClone(eventData));
    const getDataById = (id: number) => {
        return data.value.find((event) => event.id === id);
    };

    return {data,getDataById};
});