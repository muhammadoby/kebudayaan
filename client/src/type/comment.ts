import type { User } from "./user";

export interface Comment{
    user : User,
    comment: string,
    reply: {
        user: User,
        comment: string,
        created_date: Date
    }[]
    created_date: Date
}

export {};

