import { defineStore } from 'pinia';
import {ref} from 'vue';
import cultureData from '@/data/culture'
export const cultureStore = defineStore('culture',() => {
    const data = ref(structuredClone(cultureData));
    const getDataById = (id: number) => {
        return data.value.find((culture) => culture.id === id);
    };

    return {data,getDataById};
});