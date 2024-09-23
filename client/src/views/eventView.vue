<script setup lang="ts">
import { navMainStore } from '@/stores/navMain';
import { eventStore } from '@/stores/eventStore';
const navState = navMainStore();

navState.active = 'event';
const eventData = eventStore();
const formatNumber = (number: number) => {
    return number.toLocaleString('id-ID').replace(',', '.');
};
</script>
<template>
    <section class="min-h-screen" :style="{
        paddingTop: `${navState.height}px`
    }">

        <div class="container-full pb-5">
            <h1 class="text-4xl">Acara Budaya</h1>
            <div class="grid">

                <div class="col-12 lg:col-6 p-3" v-for="data in eventData.data" :key="data.id">
                    <RouterLink :to="`/event/${data.id}`">
                        <div class="shadow-3 px-3 py-3 card-item border-round-md grid">
                            <div class="sm:col-5 col-12">
                                <div>
                                    <img :src="data.image" class="w-full border-round-md img-event"
                                        :alt="`image ${data.name}`" />
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="font-semibold text-lg  mb-3">{{ data.name }}</div>

                                <div class="font-medium flex gap-2">
                                    <i class="bi bi-geo-alt"></i>
                                    <div>{{ data.location }}</div>
                                </div>
                                <div class="flex gap-2 mt-1">
                                    <i class="bi bi-ticket-perforated"></i>
                                    <div>{{ data.price ? formatNumber(data.price) : 'Gratis' }}</div>
                                </div>
                                <div class="flex gap-2 mt-1">
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
.card-item {}

.card-item:hover {
    background-color: rgba(251, 251, 251, 0.925);
}

.img-event {
    aspect-ratio: 3/2;
    object-fit: cover;
    width: 100%;
}
</style>