<script lang="ts" setup>
import { useToast } from 'primevue/usetoast';
const props = defineProps<{
    url: string,
}>();
const toast = useToast();


const visibility = defineModel<boolean>('visibility');
const copyText = async () => {
    await navigator.clipboard.writeText(props.url);
    toast.add({
        severity: 'success',
        summary: 'Salin text', detail: 'Berhasil Menyalin text',
        life: 3000
    })
}
</script>
<template>
    <PrimeToast />
    <PrimeDialog modal :draggable="false" v-model:visible="visibility" header="Edit Profile"
        :style="{ 'max-width': '25rem', width: 'calc(100% - 15px)', }">
        <template #header>
            <div class="flex w-full justify-content-center gap-2">
                <span class="font-semibold whitespace-nowrap pl-5 text-lg">BAGIKAN</span>
            </div>
        </template>
        <div class="flex gap-2">
            <div class="url-displayer w-full">
                {{ props.url }}
            </div>
            <div class="flex align-items-center">
                <button class="flex-grow-1 flex-shrink-0 copy-btn py-2" @click="copyText">Salin</button>
            </div>
        </div>
    </PrimeDialog>

</template>
<style scoped>
.url-displayer {
    border: none;
    padding: 10px;
    border-radius: 8px;
    white-space: nowrap;
    background-color: #E8E8E8;
    caret-color: transparent;
    overflow-y: scroll;
    scrollbar-width: none;
    -ms-overflow-style: none;
    scroll-padding-right: 10px;
    scroll-padding-left: 10px;
}

.url-displayer::-webkit-scrollbar {
    width: 0;
    height: 0;
}

.copy-btn {
    border: none;
    color: white;
    background-color: #00A3FF;
    padding-inline: 18px;
    border-radius: 16px;
}

.copy-btn:hover {
    background-color: #2caef9;
}
</style>