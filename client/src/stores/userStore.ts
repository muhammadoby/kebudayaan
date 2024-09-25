import type { User } from '@/type/user';
import { nanoid } from 'nanoid';
import { defineStore } from 'pinia';
import {ref} from 'vue';
export const userStore = defineStore('user',() => {
    const user = ref<User>(
        {
            id: nanoid(),
            name: 'Guest',
            avatar: new URL('/src/assets/image/avatar/avatar1.jpg',import.meta.url).href
        }
    );
    if(localStorage.getItem('user')){
        user.value = JSON.parse(localStorage.getItem('user') as string) as User;
    }else{
        localStorage.setItem('user',JSON.stringify(user.value));
    }
    

    return {user};
});

