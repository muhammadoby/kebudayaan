<script lang="ts" setup>
import NavigationMain from '@/components/NavigationMain.vue';
import { onUpdated } from 'vue';
let count = 0;
onUpdated(() => {
    console.log(count);
    count++;
});
</script>
<template>
    <NavigationMain />
</template>