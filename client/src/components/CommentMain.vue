<script setup lang="ts">
import { userStore } from '@/stores/userStore';
import type { Comment } from '@/type/comment';
import type Popover from 'primevue/popover';
import { ref, watch } from 'vue';
import type { ComponentExposed } from 'vue-component-type-helpers';

const isDialogReplyVisible = ref(false);
const user = userStore();
const replyInput = defineModel<string>('replyInput');

const props = defineProps<{
    limit: number,
    comments: (Comment & { id: number })[] | undefined
}>();

const comments = ref(
    props.comments?.map((comment) => {
        return {
            ...comment,
            isReplyhided: true,
        }
    })
);

watch(props!.comments!, () => {
    comments.value = props.comments?.map((comment) => {
        return {
            ...comment,
            isReplyhided: true,
        }
    });
});
const currentComment = ref<NonNullable<typeof comments.value>[number]>();
const showDialogReply = (id: number) => {
    currentComment.value = comments.value?.find((comment) => comment.id === id);
    isDialogReplyVisible.value = true;
}

const hideDialogReply = () => {
    isDialogReplyVisible.value = false;
}


const toggleCommentOp = (evt: Event, commentId: number) => {
    commentOp.value?.toggle(evt);
    const comment = comments.value?.find((comment) => comment.id == commentId);
    currentComment.value = comment;
}



const submitReply = () => {
    currentComment!.value!.reply = [...currentComment!.value!.reply, {
        user: user.user,
        comment: replyInput.value as string,
        created_date: new Date()
    }];
    currentComment!.value!.isReplyhided! = false;
    replyInput.value = '';
    hideDialogReply();
}
const addIdToArray = function <T extends object>(arr: T[]): ({ id: number } & T)[] {
    return arr.map((el, index) => {
        return {
            id: index,
            ...el
        }
    });
}

const showReply = (commentId: number) => {
    const comment = comments.value?.find((comment) => commentId === comment?.id);
    comment!.isReplyhided = false;
};
const hideReply = (commentId: number) => {
    const comment = comments.value?.find((comment) => commentId === comment?.id);
    comment!.isReplyhided = true;
}
const commentOp = ref<ComponentExposed<typeof Popover>>();
</script>
<template>
    <div class="comment-list mt-4">

        <div class="comment-item" v-for="comment in comments?.slice(0, Math.min(comments.length, limit))"
            :key="comment.id">
            <div class="comment-profile-pic">
                <img :src="comment.user.avatar" width="32" height="32" :alt="`Image ${comment.user.name}`" />
            </div>
            <div>
                <div class="flex justify-content-between">
                    <div class=" pb-1 flex gap-1 align-items-center">
                        <div class="font-medium">{{ comment.user.name }}</div>
                        <!-- <div>•</div>
                        <div class="text-sm"> {{ comment.created_date.toLocaleDateString('id') }}</div> -->
                    </div>
                    <div class="text-lg comment-btn-action" @click="toggleCommentOp($event, comment.id)">
                        <i class="bi bi-three-dots-vertical"></i>
                    </div>
                </div>
                <div class="comment-content">
                    {{ comment.comment }}
                </div>
                <div class="mt-2 flex gap-3">

                    <button class="btn-transparent flex gap-2 align-items-center font-medium"
                        @click="showDialogReply(comment.id)">
                        <i class="bi bi-chat text-xl"></i>
                        Balas
                    </button>
                    <button class="flex btn-transparent gap-2 align-items-center font-medium"
                        v-if="comment.reply.length && comment.isReplyhided" @click="showReply(comment.id)">
                        Lihat Balasan
                    </button>
                    <div class="flex gap-2 align-items-center font-medium"
                        v-if="comment.reply.length && !comment.isReplyhided" @click="hideReply(comment.id)">
                        Sembunyikan balasan
                    </div>
                </div>
                <div class="mt-2 flex flex-column " v-if="comment.reply.length && !comment.isReplyhided">
                    <div class="comment-item reply-item pl-3 pt-3" v-for="reply in addIdToArray(comment.reply)"
                        :key="reply.id">
                        <div class="comment-profile-pic">
                            <img :src="reply.user.avatar" width="32" height="32" />
                        </div>
                        <div>
                            <div class="flex justify-content-between">
                                <div class=" pb-1 flex gap-1 align-items-center">
                                    <div class="font-medium">{{ reply.user.name }}</div>
                                    <!-- <div>•</div>
                        <div class="text-sm"> {{ comment.created_date.toLocaleDateString('id') }}</div> -->
                                </div>
                                <div class="text-lg comment-btn-action" @click="toggleCommentOp($event, comment.id)">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </div>
                            </div>
                            <div class="comment-content">
                                {{ reply.comment }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
    <PrimePopover ref="commentOp">
        <div class="comment-action-list">
            <div>Laporkan komentar</div>
            <!-- <div v-if="currentComment?.user.id === user.user.id">Hapus komentar</div> -->
        </div>
    </PrimePopover>
    <PrimeDialog v-model:visible="isDialogReplyVisible" :draggable="false" modal
        :style="{ 'max-width': '400px', 'width': 'calc(100% - 10px)' }">
        <template #header>
            <div class="inline-flex items-center justify-center gap-2">
                <span class="font-bold whitespace-nowrap">Balas Komentar</span>
            </div>
        </template>
        <div>
            <textarea class="w-full input-comment-reply" placeholder="Balas" rows="4" v-model="replyInput"></textarea>

        </div>
        <div class="mt-2">
            <button class="comment-send-btn" @click="submitReply">Kirim</button>
            <button class="comment-reply-cancel-btn ml-3" @click="hideDialogReply">Batal</button>
        </div>
    </PrimeDialog>
</template>
<style scoped>
.comment-item {
    padding-bottom: 20px;
    column-gap: 15px;
    display: grid;
    grid-template-columns: max-content 1fr;
}

.comment-profile-pic>img {
    border-radius: 50%;
    object-fit: cover;
}

.comment-btn-action {
    padding-left: 13px;
}

.comment-input {
    border: solid 1px rgb(193, 194, 194);
}

.comment-send-btn {
    border: 0;
    font-weight: 600;
    background-color: #00A3FF;
    color: white;
    padding: 7px 20px;
    border-radius: 8px;
    transition: background-color 500ms;
}

.reply-item:nth-child(even) {
    background-color: rgb(249, 239, 239);
}

.comment-send-btn:hover {
    background-color: #0f419e;
}

.comment-reply-cancel-btn {
    border: 0;
    font-weight: 600;
    color: white;
    padding: 7px 20px;
    border-radius: 8px;
    background-color: rgb(228, 16, 16);
    transition: background-color 500ms;
}

.comment-reply-cancel-btn:hover {
    background-color: rgb(139, 13, 13);
}

.input-comment-reply {
    padding: 10px;
    border: solid 1px rgb(193, 194, 194);
    border-radius: 8px;
    outline: none;
}

.comment-action-list {
    display: flex;
    gap: 10px;
    flex-direction: column;
}

.comment-action-list>div:hover {
    background-color: rgb(246, 246, 246);
}
</style>