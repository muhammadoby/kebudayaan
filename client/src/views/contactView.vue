<script setup lang="ts">
import { navMainStore } from "@/stores/navMain";
import { ref } from "vue";
import { useToast } from "primevue/usetoast";
import z from 'zod';
const toast = useToast();

const navState = navMainStore();

navState.active = 'contact';
const showSuccess = () => {
  toast.add({
    severity: "success",
    summary: "Pesan terkirim",
    detail: "Pesan berhasil dikirim",
    life: 3000,
  });
};

const errors = ref({
  name: "",
  email: "",
  phone: "",
  message: "",
});

const formData = ref({
  name: "",
  email: "",
  phone: "",
  message: "",
});

const submitContactForm = async () => {
  Object.keys(errors.value).forEach((key) => {
    errors.value[key as keyof typeof errors['value']] = '';
  });
  const validator = z.object({
    name: z.string().min(1, {
      'message': 'Nama wajib diisi'
    }),
    email: z.string().min(1, {
      message: 'Email wajib diisi'
    }).email({
      message: 'Email tidak valid'
    }),
    phone: z.string().min(1, {
      message: 'Nomor telepon wajib diisi'
    }),
    message: z.string().min(1, {
      message: 'Pesan wajib diisi wajib diisi'
    })
  });
  const safeValidate = validator.safeParse(formData.value);
  if (!safeValidate.success) {
    const error = safeValidate.error.flatten().fieldErrors;
    Object.keys(error).forEach((key) => {
      type keyType = keyof typeof errors.value;
      errors.value[key as keyType] = (error[key as keyType] as Exclude<typeof error[keyType], undefined>)[0];
    });
    return;
  }

  showSuccess();
  Object.keys(formData.value).forEach((key) => {
    formData.value[key as keyof typeof formData['value']] = '';
  });

  // }
};
</script>
<template>
  <PrimeToast />
  <div class="grid grid-nogutter contact" :style="{
    '--padding-top': `${navState.height}px`
  }">
    <div class="side-content col-4 lg:flex hidden">
      <div>
        <div>
          <div class="font-medium side-content-brand-name">CONTACT US</div>
        </div>
        <div class="mt-3">
          <div>Sampaikan Pesan Anda Melalui Form</div>
        </div>
      </div>
    </div>
    <div class="lg:col-8 col-12 pb-4 h-full">
      <div class="flex flex-column align-items-center md:px-5 lg:px-3 px-4">
        <div class="h-full w-full flex flex-column justify-content-center align-items-center pt-5">
          <h1 class="contact-title text-center mt-1">Contact US</h1>
          <form class="contact-form pb-4" @submit.prevent="submitContactForm">
            <div class="input-group">
              <div class="contact-label-input">Name</div>
              <input v-model="formData.name" class="contact-input" :class="{ 'is-error': errors.name }"
                placeholder="Enter your name" />
              <div class="input-error-text" v-if="errors.name">
                {{ errors.name }}
              </div>
            </div>
            <div class="input-group">
              <div class="contact-label-input">email</div>
              <input v-model="formData.email" class="contact-input" placeholder="Enter your email"
                :class="{ 'is-error': errors.name }" />
              <div class="input-error-text" v-if="errors.email">
                {{ errors.email }}
              </div>
            </div>
            <div class="input-group">
              <div class="contact-label-input">Phone</div>
              <input v-model="formData.phone" class="contact-input" placeholder="Enter your phone"
                :class="{ 'is-error': errors.name }" />
              <div class="input-error-text" v-if="errors.phone">
                {{ errors.phone }}
              </div>
            </div>
            <div class="input-group">
              <div class="contact-label-input">Message</div>
              <textarea v-model="formData.message" class="contact-input" placeholder="Enter your message"
                :class="{ 'is-error': errors.name }"></textarea>
              <div class="input-error-text" v-if="errors.message">
                {{ errors.message }}
              </div>
            </div>
            <div>
              <button class="contact-submit-btn" type="submit">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.side-content {
  padding: 120px 50px;
  display: flex;
  align-items: end;
  justify-content: center;
  color: rgb(255, 252, 252);
  background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
    url("@/assets/image/register.png");
  background-position: 0%;
  background-size: cover;
}

.side-content>div {
  align-items: end;
}

.side-content-brand-name {
  font-size: clamp(2.5rem, 1rem + 2vw, 3rem);
}

.contact-title {
  font-size: 2rem;
  font-weight: 700;
  position: relative;
  padding-bottom: 15px;
  width: 100%;
  text-transform: uppercase;
}

.contact-title::before {
  content: "";
  left: 50%;
  transform: translateX(-50%);
  max-width: 450px;
  width: 100%;
  position: absolute;
  bottom: 0;
  height: 1px;
  border: solid 1px #827f7f;
}

.contact-subtitle {
  font-weight: inherit;
  font-size: 1rem;
  max-width: 420px;
  text-align: center;
}

.contact-form {
  margin-top: 10px;
  max-width: 600px;
  width: 100%;
}

.contact-label-input {
  font-weight: 600;
  margin-bottom: 3px;
  text-transform: capitalize;
}

.contact-input {
  padding: 15px;
  width: 100%;
  font-family: poppins, sans-serif;
  border-radius: 8px;
  border: transparent;
  background-color: #f2f2f2;
}

.contact-input:focus {
  outline: solid 2px rgb(57, 60, 160);
}

.contact-input.is-error:focus {
  outline: solid 2px red;
}

.input-error-text {
  color: red;
  font-size: 0.9rem;
}

.input-group {
  margin-bottom: 17px;
}

.contact-submit-btn {
  border: none;
  margin-top: 14px;
  background-color: #00a3ff;
  padding: 13px;
  font-weight: 700;
  color: white;
  border-radius: 8px;
  width: 100%;
}

.ic-register {
  width: 1.5rem;
  aspect-ratio: 1/1;
}

.text-register-question {
  font-size: 0.86rem;
  margin-top: 5px;
  text-align: center;
}

.error-icon {
  margin-right: 1px;
  font-size: 1.1rem;
  vertical-align: middle;
}

.contact {
  padding-top: var(--padding-top);
  min-height: calc(100vh - var(--padding-top));
}
</style>
