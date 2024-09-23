<script setup lang="ts">
import { ref } from 'vue';
import { navMainStore } from '@/stores/navMain';
import { eventStore } from '@/stores/eventStore';
import { useRoute, useRouter } from 'vue-router';
const route = useRoute();
const router = useRouter();
const eventData = eventStore();
const data = eventData.getDataById(parseInt(route.params.id as string));
if (!data) {
    router.replace('/notfound');
}
const nav = navMainStore();
const isReportDialogVisible = ref(false);
const showReportDialog = () => {
    isReportDialogVisible.value = true;
};
const hideReportDialog = () => {
    isReportDialogVisible.value = false;
}
const formatDate = (date: Date) => {
    return new Intl.DateTimeFormat('id').format(date);
}
const formatTime = (date: Date) => {
    const userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    return date.toLocaleTimeString('id', { hour: '2-digit', minute: '2-digit', timeZone: userTimezone });
}
nav.active = 'event';
</script>
<template>
    <section class="hero lg:h-screen flex align-items-center text-white "
        :style="{ '--padding-top': `${nav.height}px`, '--background-image': `url(${data?.image})` }">
        <div class="container-full flex justify-content-center flex-column align-items-center py-8">
            <div class=" hero-text-title font-medium">{{ data?.name }}</div>
            <div class="mt-2 text-2xl font-medium">{{ data?.status }}</div>
            <div class="flex text-blue mt-4 gap-4">
                <div class="flex gap-2 align-items-center">
                    <i class="bi bi-share-fill text-xl"></i>
                    <div>Bagikan</div>
                </div>
                <div class="flex gap-2 align-items-center">
                    <i class="bi bi-calendar text-xl"></i>
                    <div>Tambahkan ke kalender</div>
                </div>
            </div>
        </div>
    </section>
    <div class="container-full mt-6">
        <div class="grid">
            <div class="lg:col-8 col-12">
                <section class="about">
                    <h1 class="main-title font-semibold mt-6 mb-3">Tentang Acara</h1>
                    <div class="line-height-3">
                        {{ data?.description }}
                    </div>
                </section>
                <section class="information">
                    <h1 class="main-title font-semibold mt-6 mb-1">Informasi Acara</h1>
                    <div class="line-height-3">
                        <div class="grid-information ">
                            <div class="flex gap-3">
                                <i class="bi bi-geo-alt text-xl"></i>
                                <div>
                                    <div class="font-semibold">Lokasi acara</div>
                                    <div>{{ data?.location }}</div>
                                </div>
                            </div>
                            <div class="flex gap-3 mt-4">
                                <i class="bi bi-pen text-xl"></i>
                                <div>
                                    <div class="font-semibold">Penyelenggara</div>
                                    <div>{{ data?.organizer }}</div>
                                </div>
                            </div>
                            <div class="flex gap-3 mt-4">
                                <i class="bi bi-calendar text-xl"></i>
                                <div>
                                    <div class="font-semibold">Jadwal Acara</div>
                                    <div>
                                        {{ formatDate(data?.startDate as Date) }}
                                        ({{ formatTime(data?.startDate as Date) }})
                                        -
                                        {{ formatDate(data?.endDate as Date) }}
                                        ({{ formatTime(data?.endDate as Date) }})
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-3 mt-4">
                                <i class="bi bi-ticket-perforated text-xl"></i>
                                <div>
                                    <div class="font-semibold">Harga Tiket</div>
                                    <div>{{ data?.price || 'Gratis' }}</div>
                                </div>
                            </div>
                            <div class="flex gap-3 mt-4" v-if="data?.buyMethod">
                                <i class="bi bi-patch-question text-xl"></i>
                                <div>
                                    <div class="font-semibold">Cara membeli</div>
                                    <div>{{ data?.buyMethod }}</div>
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
                    <h1 class="main-title font-semibold mt-6 mb-3">Kategori Acara</h1>
                    <div class="flex gap-3">
                        <div class="category-item">
                            Kesenian
                        </div>
                        <div class="category-item">
                            Acara tahunan
                        </div>
                        <div class="category-item">
                            Pesta kesenian
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
                                        placeholder="Tambahkan komentar"></textarea>
                                </div>
                                <div class="mt-1">
                                    <button class="comment-send-btn">Kirim</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <CommentMain />
                    <div class="text-center">
                        <button class="see-all-comment-btn">Lihat komentar Lainnya</button>
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
                        <div>Laporkan acara</div>
                    </div>
                </section>
            </div>
            <div class="lg:col-4 col-12 lg:pl-6">
                <section class="related-culture">
                    <h1 class="main-title font-semibold mb-3">Acara serupa</h1>
                    <div class="grid">
                        <div class="flex gap-2 lg:col-12 sm:col-6 col-12 related-culture-item">
                            <div>
                                <img src="@/assets/image/home/grid-img1.jpg" width="80" alt="hero image"
                                    class="border-round-md" />

                            </div>
                            <div>
                                <div class="text-lg font-medium"> Pesta kesenian bali</div>
                                <div>Gratis</div>
                            </div>
                        </div>
                        <div class="flex gap-2 lg:col-12 sm:col-6 col-12 related-culture-item">
                            <div>
                                <img src="@/assets/image/home/grid-img1.jpg" width="80" alt="hero image"
                                    class="border-round-md" />

                            </div>
                            <div>
                                <div class="text-lg font-medium"> pesta kesenian bali</div>
                                <div>Gratis </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

</template>

<style scoped>
.hero {
    background: linear-gradient(rgba(0, 0, 0, 0.7),
            rgba(0, 0, 0, 0.7)), var(--background-image);
    background-repeat: no-repeat;
    background-size: cover;
}

.hero-timer-grid {
    display: grid;
    gap: 26px;
    grid-template-columns: repeat(4, 1fr);
}

.hero-text-timer {
    line-height: 1;
    color: #00A3FF;
    font-size: 4rem;
}

.comment-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.main-title {
    font-size: clamp(0.9rem, 0.5rem + 3vw, 1.2rem);
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

.max-line-5 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 5;
    line-clamp: 5;
    -webkit-box-orient: vertical;
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

.comment-send-btn:hover {
    background-color: #0f419e;
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

.input-report {
    padding: 10px;
    border: solid 1px rgb(193, 194, 194);
    border-radius: 8px;
    outline: none;
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