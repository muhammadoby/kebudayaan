import type { User } from '@/type/user';
import {faker} from '@faker-js/faker';
import { nanoid } from 'nanoid';
const randomNumber = (min: number,max: number) => {
    return faker.number.int({min,max});
}
export default function () : User {
    const userNames = ['Putu Adi','Ahmad Doni','Doni','Adi putu','Ahmad','Adi'];
    const avatarPics = ['avatar1.jpg','avatar2.jpg','avatar3.jpg','avatar4.jpg','avatar5.jpg'];
    return {
        id: nanoid(),
        name: userNames[randomNumber(0, userNames.length - 1)],
        avatar: new URL(`/src/assets/image/avatar/${avatarPics[randomNumber(0, avatarPics.length - 1)]}`,import.meta.url).href,
    }
} 