<script setup lang="ts">
import { cultureStore } from '@/stores/cultureStore';
import { navMainStore } from '@/stores/navMain';
const navState = navMainStore();
const cultureData = cultureStore();
navState.active = 'culture';

</script>
<template>
    <section class="min-h-screen" :style="{
        paddingTop: `${navState.height}px`
    }">

        <div class="container-full pb-5">
            <h1 class="text-4xl">Jelajahi Budaya</h1>
            <div class="grid">
                <div class="col-12 lg:col-6 px-3" v-for="data in cultureData.data" v-bind:key="data.id">
                    <RouterLink :to="`/culture/${data.id}`">
                        <div class="shadow-3 px-3 py-3 card-culture border-round-md grid">
                            <div class="sm:col-5 col-12">
                                <div>
                                    <img :src="data.image" class="w-full border-round-md img-culture"
                                        :alt="`image ${data.name}`" />
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="font-semibold text-lg  mb-3">{{ data.name }}</div>
                                <div class="font-medium flex gap-2">
                                    <i class="bi bi-geo-alt"></i>
                                    <div>{{ data.location }}</div>
                                </div>
                                <div class="flex gap-2 mt-2">
                                    <i class="bi bi-pencil"></i>
                                    <div class="font-medium">{{ data.writter }}</div>
                                </div>
                                <div class="flex gap-2 mt-2">
                                    <i class="bi bi-newspaper"></i>
                                    <div class="max-line-2 mt-1">
                                        {{ data.description }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </RouterLink>
                </div>
            </div>


        </div>
    </section>
</template>
<style scoped>
.card-culture {}

.card-culture:hover {
    background-color: rgba(251, 251, 251, 0.925);
}

.img-culture {
    aspect-ratio: 3/2;
    width: 100%;
    object-fit: cover;
}
</style>