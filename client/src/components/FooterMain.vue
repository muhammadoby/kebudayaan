<template>
    <footer class="footer">
        <div class="container-full py-4">
            <div class="grid">
                <div class="col-2  flex-column justify-content-center align-items-center hidden lg:flex">
                    <img src="@/assets/image/logo.png" class="img-footer" />
                    <div class="font-medium text-lg">Explore Budaya</div>
                </div>
                <div class="lg:col-2 col-12 lg:pl-5">
                    <div>
                        <h1 class="font-semibold text-lg ">Ringkasan</h1>
                        <div class="font-normal">
                            <div class="mt-2">
                                <RouterLink to="/" class="footer-link">Home</RouterLink>
                            </div>
                            <div class="mt-2">
                                <RouterLink to="/culture" class="footer-link">Budaya</RouterLink>
                            </div>
                            <div class="mt-2">
                                <RouterLink to="/event" class="footer-link">Acara</RouterLink>
                            </div>
                            <div class="mt-2">
                                <RouterLink to="/contact" class="footer-link">Contact</RouterLink>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h1 class="font-semibold text-lg mb-0">Sosial Media</h1>
                        <div class="flex gap-3">
                            <div class="mt-2">
                                <img src="@/assets/image/icon/ic-instagram.svg" width="25" alt="Instagram" />
                            </div>
                            <div class="mt-2">
                                <img src="@/assets/image/icon/ic-facebook.svg" width="25" alt="Facebook" />
                            </div>
                            <div class="mt-2">
                                <img src="@/assets/image/icon/ic-twitter.svg" width="30" alt="Twitter" />
                            </div>
                        </div>
                    </div>

                </div>
                <div class="lg:col-4 col-12 lg:pl-3">
                    <div>
                        <h1 class="font-semibold text-lg ">Tentang Explore budaya</h1>
                        <div class="font-normal">
                            Explore Budaya adalah wadah bagi kebudayaan-kebudayaan yang ada hampir di seluruh wilayah
                            atau Pulau yang ada di Indonesia mulai dari sabang sampai merauke.
                        </div>
                    </div>
                </div>
                <div class="lg:col-3 lg:pl-6 col-8">
                    <h1 class="font-semibold text-lg ">Galeri</h1>
                    <div class="grid">
                        <div class="col-6">
                            <div>
                                <img src="@/assets/image/footer/footer1.png" class="w-full" alt="Image gallery" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <img src="@/assets/image/footer/footer2.jpg" class="w-full" alt="Image gallery" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <img src="@/assets/image/footer/footer3.jpg" class="w-full" alt="Image gallery" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <img src="@/assets/image/footer/footer4.jpg" class="w-full" alt="Image galleryp" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="text-center copyright">
            © 2024 Explore Budaya. All Rights Reserved
        </div>
    </footer>
</template>
<style scoped>
.footer {
    color: white;
    background-color: #212020;
}

.img-footer {
    width: 150px;
    aspect-ratio: 1/1;
}

.copyright {
    padding: 10px;
    background-color: rgb(24, 23, 23);
}

.footer-link:hover {
    text-decoration: underline;
}
</style>