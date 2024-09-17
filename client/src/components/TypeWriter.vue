<script setup lang="ts">
import { computed, onMounted, ref } from 'vue';

const props = defineProps<{
    data: string[]
}>();

const dataLength = computed(() => {
    return props.data.length;
});

let isTypeWritterEnd = ref(false);
let currentDataIdx = ref(0);
let typeWriteWidth = ref(0);
const maxWidth = ref(0);
const typewriter = ref<HTMLElement>();
const onAnimationEnd = (evt: Event) => {
    isTypeWritterEnd.value = !isTypeWritterEnd.value;
    if (!isTypeWritterEnd.value) {
        let idx = currentDataIdx.value + 1;
        currentDataIdx.value = idx >= dataLength.value ? 0 : idx;
    }
    typeWriteWidth.value = (evt.target as HTMLElement).clientWidth;
};
onMounted(() => {
    maxWidth.value = typewriter.value?.clientWidth as number;
});

</script>

<template>
    <span ref="typewriter" class="inline-block typewriter"
        :class="{ 'start': !isTypeWritterEnd, 'end': isTypeWritterEnd }" :style="{ 'width': `${typeWriteWidth}px` }"
        @animationend="onAnimationEnd">
        <slot :text="props.data[currentDataIdx]"></slot>
    </span>
</template>

<style scoped>
.typewriter.start {
    animation:
        typing 2s steps(30, end) forwards;
}

.typewriter.end {
    animation: reverse-typing 2s steps(30, end) forwards;
}

@keyframes typing {
    0% {
        width: 0%;
    }

    100% {
        width: 100%;
    }
}

@keyframes reverse-typing {
    0% {
        width: 100%;
    }

    100% {
        width: 0;
    }
}
</style>