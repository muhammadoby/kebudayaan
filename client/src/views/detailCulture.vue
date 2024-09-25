<script setup lang="ts">
import { ref } from 'vue';
import { navMainStore } from '@/stores/navMain';
import type { ComponentExposed } from 'vue-component-type-helpers';
import type ImgDetail from '@/components/ImgDetail.vue';
import { useRoute, useRouter } from 'vue-router';
import { cultureStore } from '@/stores/cultureStore';
import { useToast } from 'primevue/usetoast';

const toast = useToast();
const loadImage = (imgName: string) => {
    return new URL(`/src/assets/image/home/${imgName}`, import.meta.url).toString();
};
const cultureData = cultureStore();
const router = useRouter();
const route = useRoute();
const data = cultureData.getDataById(parseInt(route.params.id as string));
if (!data) {
    router.replace('/notfound');
}
const isLoading = ref(false);
const relatedCulture = cultureData.data.slice(0, 2);
const dataImage = ref([
    loadImage('grid-img1.jpg'),
    loadImage('grid-img2.jpg'),
    loadImage('grid-img4.jpg'),
    loadImage('grid-img1.jpg'),
    loadImage('grid-img2.jpg'),
    loadImage('grid-img4.jpg'),
]);
const imgDetail = ref<ComponentExposed<typeof ImgDetail>>();
const nav = navMainStore();
nav.active = 'culture';
const showReportDialog = () => {
    isReportDialogVisible.value = true;
};
const hideReportDialog = () => {
    isReportDialogVisible.value = false;
}
const isReportDialogVisible = ref(false);
const carouselResponsiveOptions = ref([
    {
        breakpoint: '767px',
        numVisible: 2,
        numScroll: 1
    },
    {
        breakpoint: '500px',
        numVisible: 1,
        numScroll: 1
    }
]);
const seeMoreClick = () => {
    isLoading.value = true;
    setTimeout(() => {
        isLoading.value = false;
        limit.value = limit.value + perPage;
    }, 2000);
}
const perPage = 3;
const limit = ref(perPage);
const imageClick = (index: number) => {
    imgDetail.value?.setIndex(index);
    imgDetail.value?.toggleActive(true);
};
const inputComment = defineModel<string>('inputComment');
const addComment = () => {
    if (!inputComment.value) {
        return;
    }
    toast.add({
        severity: 'success',
        summary: 'Sukses',
        detail: 'Sukses menambahkan komentar', life: 3000
    });
    cultureData.addComment(data?.id as number, inputComment.value);
    inputComment.value = '';

}
</script>
<template>
    <PrimeToast />
    <ImgDetail :img="dataImage" ref="imgDetail" />
    <section class="hero xl:h-screen flex align-items-center" :style="{ '--padding-top': `${nav.height}px` }">
        <div class="container-full ">
            <div class="grid-hero">
                <div class="flex align-items-end h-full pb-6 sm:pb-8">
                    <div>
                        <h1 class="text-white font-semibold mb-0 hero-text-title">{{ data?.name }}</h1>
                        <div class="text-xl text-white font-medium">oleh {{ data?.writter }}</div>
                        <div class="flex text-blue mt-4 gap-4">
                            <div class="flex gap-2 align-items-center">
                                <i class="bi bi-share-fill text-xl"></i>
                                <div class="hidden sm:block">Bagikan</div>
                            </div>
                            <div class="flex gap-2 align-items-center">
                                <i class="bi bi-bookmark-fill text-xl"></i>
                                <div class="hidden sm:block">Tambahkan ke bookmark</div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img :src="data?.image" class="w-full grid-hero-img px-1" alt="hero image" />
                    <div class="darken-gradient"></div>
                </div>
            </div>
        </div>
    </section>
    <div class="container-full mt-6">
        <div class="grid">
            <div class="lg:col-8 col-12">
                <section class="carousel-culture">
                    <PrimeCarousel :value="dataImage" :numScroll="1" :numVisible="2" :pt="{
                        pcPrevButton: {
                            root: {
                                class: 'carousel-culture-prev-btn'
                            }
                        },
                        pcNextButton: {
                            root: {
                                class: 'carousel-culture-next-btn'
                            }
                        }
                    }" :showIndicators="false" :responsiveOptions="carouselResponsiveOptions">
                        <template #previcon>
                            <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px"
                                fill="black">
                                <path d="M640-80 240-480l400-400 71 71-329 329 329 329-71 71Z" />
                            </svg>
                        </template>
                        <template #item="props">
                            <div class="px-2" @click="imageClick(props.index)">
                                <img :src="props.data" class="w-full bright border-round-md" alt="carousel image" />
                            </div>
                        </template>
                        <template #nexticon>
                            <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px"
                                fill="black">
                                <path d="m321-80-71-71 329-329-329-329 71-71 400 400L321-80Z" />
                            </svg>
                        </template>

                    </PrimeCarousel>
                </section>
                <section class="about-culture">
                    <h1 class="main-title font-semibold mt-6 mb-3">Tentang Kebudayaan</h1>
                    <div class="about-culture-content line-height-3">
                        {{ data?.description }}
                    </div>
                </section>
                <section class="information">
                    <h1 class="main-title font-semibold mt-6 mb-1">Informasi Tulisan</h1>
                    <div class="about-culture-content line-height-3">
                        <div class="grid-information ">
                            <div class="flex gap-3">
                                <i class="bi bi-geo-alt text-xl"></i>
                                <div>
                                    <div class="font-semibold">Asal budaya</div>
                                    <div>{{ data?.location }}</div>
                                </div>
                            </div>
                            <div class="flex gap-3 mt-4">
                                <i class="bi bi-pen text-xl"></i>
                                <div>
                                    <div class="font-semibold">Penulis</div>
                                    <div>{{ data?.writter }}</div>
                                </div>
                            </div>
                            <div class="flex gap-3 mt-4">
                                <i class="bi bi-calendar text-xl"></i>
                                <div>
                                    <div class="font-semibold">Tanggal dibuat</div>
                                    <div>{{ new Intl.DateTimeFormat('id').format(data?.date) }}</div>
                                </div>
                            </div>
                            <div class="flex gap-3 mt-4">
                                <i class="bi bi-eye text-xl"></i>
                                <div>
                                    <div class="font-semibold">Dilihat</div>
                                    <div>{{ data?.view }} orang</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="category">
                    <h1 class="main-title font-semibold mt-6 mb-3">Kategori Kebudayaan</h1>
                    <div class="flex gap-3">
                        <div class="category-item">
                            Tarian
                        </div>
                        <div class="category-item">
                            Sakral
                        </div>
                        <div class="category-item">
                            Upacara
                        </div>
                    </div>
                </section>
                <section class="comment">
                    <h1 class="main-title font-semibold mt-6 mb-3">Komentar</h1>
                    <div>
                        <div class="flex gap-3 ">
                            <div class="comment-profile-pic">
                                <img src="@/assets/image/home/grid-img1.jpg" width="32" height="32" />
                            </div>
                            <div class="w-full">
                                <div class="w-full">
                                    <textarea class="w-full px-3  py-2 border-round-lg comment-input" rows="3"
                                        v-model="inputComment" placeholder="Tambahkan komentar"></textarea>
                                </div>
                                <div class="mt-1">
                                    <button class="comment-send-btn" @click="addComment">Kirim</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <CommentMain :limit="limit" :comments="data?.comment" />
                    <div class="flex justify-content-center">
                        <LoadingSpinner v-if="isLoading" />
                    </div>
                    <div class="text-center" v-if="!isLoading && (limit < (data?.comment.length ?? 0))">
                        <button @click="seeMoreClick" class="see-all-comment-btn">
                            Lihat {{
                                Math.max((data?.comment.length ??
                                    0) - limit, 0)
                            }} komentar Lainnya </button>
                    </div>
                </section>
                <section class="mt-4 mb-5">
                    <PrimeDialog v-model:visible="isReportDialogVisible" :draggable="false" modal
                        :style="{ 'max-width': '400px', 'width': 'calc(100% - 10px)' }">
                        <template #header>
                            <div class="inline-flex items-center justify-center gap-2">
                                <span class="font-bold whitespace-nowrap">Laporkan tulisan</span>
                            </div>
                        </template>
                        <div>
                            <textarea class="w-full input-report" placeholder="Berikan alasanmu" rows="4"></textarea>

                        </div>
                        <div class="mt-2">
                            <button class="report-send-btn">Kirim</button>
                            <button class="report-cancel-btn ml-3" @click="hideReportDialog">Batal</button>
                        </div>
                    </PrimeDialog>
                    <div class="font-medium flex gap-3 align-items-center" @click="showReportDialog">
                        <i class="bi bi-flag text-lg"></i>
                        <div>Laporkan Tulisan</div>
                    </div>
                </section>
            </div>
            <div class="lg:col-4 col-12 lg:pl-6">
                <section class="related-culture">
                    <h1 class="main-title font-semibold mb-3">Tulisan serupa</h1>
                    <div class="grid">
                        <div class="lg:col-12 sm:col-6 col-12 related-culture-item" v-for="data in relatedCulture"
                            :key="data.id">
                            <RouterLink :to="`/culture/${data.id}`" class="flex  gap-2">
                                <div>
                                    <img :src="data.image" width="80" :alt="`image ${data.name}`"
                                        class="border-round-md" />

                                </div>
                                <div>
                                    <div class="text-lg font-medium"> {{ data.name }}</div>
                                    <div>{{ data.writter }}</div>
                                </div>
                            </RouterLink>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

</template>

<style scoped>
.comment-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.main-title {
    font-size: clamp(1.25rem, 0.5rem + 3vw, 1.6rem);
}

.border-abc {
    display: none !important;
    background-color: red;
}

.hero-text-title {
    font-size: clamp(1.6rem, 3vw + 0.5rem, 3rem);
}


.text-blue {
    color: #00A3FF;
}

.darken-gradient {
    width: 100%;
    top: 0;
    left: 0;
    pointer-events: none;
    position: absolute;
    height: 100%;
    background: linear-gradient(to right, rgb(32, 33, 36), rgba(0, 0, 0, 0) 56%), linear-gradient(to top, rgb(32, 33, 36) 0, rgba(0, 0, 0, 0) 56%), linear-gradient(to left, rgb(32, 33, 36) 0, rgba(0, 0, 0, 0) 56%);

}

.hero {
    background-color: rgb(32, 33, 36);
    padding-top: var(--padding-top);
}

.grid-hero {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    grid-template-rows: 1fr;
}

.grid-hero>div:nth-child(1) {
    grid-column: 1/6;
    grid-row: 1;
    z-index: 2;
}

.grid-hero>div:nth-child(2) {
    grid-column: 4 / 13;
    grid-row: 1;
}

.grid-hero-img {
    aspect-ratio: 100/60;
    object-fit: cover;
}

.p-carousel-indicator-list {
    display: none
}

.carousel-culture {
    position: relative;
}

.carousel-culture :deep(.carousel-culture-next-btn) {
    /* right: calc(-20px + 0.6vw); */
    right: 0;
    transform: translate(30%);
}

.carousel-culture :deep(.carousel-culture-prev-btn) {
    left: 0px;
    transform: translate(-30%);
}

.carousel-culture :deep(.carousel-culture-prev-btn),
.carousel-culture :deep(.carousel-culture-next-btn) {
    z-index: 3 !important;
    position: absolute;
    border-radius: 50%;
    color: black;
    width: max-content;
    height: max-content;
    font-weight: 600;
    font-size: clamp(0.5rem, 0.3rem + 1vw, 1rem);
    padding: 1em 1.2em;
    box-shadow: 0px 1px 8px rgba(0, 0, 0, 0.08), 0px 3px 4px rgba(0, 0, 0, 0.1), 0px 1px 4px -1px rgba(0, 0, 0, 0.1);
    background-color: white;
    font-family: inherit;

}

.carousel-culture :deep(.p-disabled) {
    display: none;
}

.grid-information {
    border: 1px solid rgb(193, 194, 194);
    border-radius: 16px;
    padding: 20px 30px;
}

.category-item {
    border: none;
    border-radius: 16px;
    font-weight: 500;
    background-color: hsl(0, 0%, 91%);
    padding: 8px 15PX;
}

.report-send-btn {
    border: 0;
    font-weight: 600;
    background-color: #00A3FF;
    color: white;
    padding: 7px 20px;
    border-radius: 8px;
    transition: background-color 500ms;
}

.report-send-btn:hover {
    background-color: #0f419e;
}

.report-cancel-btn {
    border: 0;
    font-weight: 600;
    color: white;
    padding: 7px 20px;
    border-radius: 8px;
    background-color: rgb(228, 16, 16);
    transition: background-color 500ms;
}

.report-cancel-btn:hover {
    background-color: rgb(139, 13, 13);
}

.input-report {
    padding: 10px;
    border: solid 1px rgb(193, 194, 194);
    border-radius: 8px;
    outline: none;
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

.see-all-comment-btn {
    padding: 8px 15px;
    border: none;
    border-radius: 8px;
    background-color: transparent;
    color: #00A3FF;
    font-weight: 600;
}

.related-culture-item:hover {
    border-radius: 8px;
    background-color: rgb(246, 246, 246);
}

.comment-profile-pic>img {
    border-radius: 50%;
    object-fit: cover;
}

@media (max-width: 992px) {
    .grid-hero>div:nth-child(1) {
        grid-column: 1/-1;
        grid-row: 1;
        z-index: 2;
    }

    .grid-hero>div:nth-child(2) {
        grid-column: 1 / -1;
        grid-row: 1;
    }
}



@media screen and (max-width: 576px) {
    .grid-hero>div:nth-child(1) {
        grid-column: 1/-1;
        grid-row: 2;
        z-index: 2;
    }

    .grid-hero>div:nth-child(2) {
        grid-column: 1 / -1;
        grid-row: 1;
    }

    .grid-hero-img {
        aspect-ratio: 100/55;
    }

    .carousel-culture :deep(.carousel-culture-next-btn) {
        transform: translate(15%);
    }

    .carousel-culture :deep(.carousel-culture-prev-btn) {
        transform: translate(-15%);
    }
}
</style>