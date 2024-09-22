<script setup lang="ts">
import { navMainStore } from '@/stores/navMain';
const navState = navMainStore();


</script>
<template>
    <section class="min-h-screen" :style="{
        paddingTop: `${navState.height}px`
    }">

        <div class="container-full pb-5">
            <h1 class="text-4xl">Acara Budaya</h1>
            <div class="grid">
                <div class="col-12 lg:col-6">
                    <div class="shadow-3 px-3 py-3 card-item border-round-md grid">
                        <div class="sm:col-5 col-12">
                            <div>
                                <img src="@/assets/image/home/grid-img1.jpg" class="w-full border-round-md"
                                    alt="hero image" />
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="font-semibold text-lg  mb-3">Pesta kesenian Bali</div>

                            <div class="font-medium flex gap-2">
                                <i class="bi bi-geo-alt"></i>
                                <div>Jalan provisi bali</div>
                            </div>
                            <div class="flex gap-2 mt-1">
                                <i class="bi bi-ticket-perforated"></i>
                                <div>10.000</div>
                            </div>
                            <div class="flex gap-2 mt-1">
                                <i class="bi bi-newspaper"></i>
                                <div class="max-line-2 mt-1">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum
                                    has
                                    been
                                    the industry's standard dummy text ever since the 1500s, when an unknown printer
                                    took a
                                    galley
                                    of type and scrambled it to make a type specimen book. It has survived not only five
                                    centuries,
                                    but also the leap into electronic typesetting, remaining essentially unchanged. It
                                    was
                                    popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                                    passages,
                                    and more recently with desktop publishing software like Aldus PageMaker including
                                    versions
                                    of
                                    Lorem Ipsum
                                </div>
                            </div>
                        </div>
                    </div>
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
</style>