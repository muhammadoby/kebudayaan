import axios from "axios";
import { ref } from "vue";
export const submitForm = async <T extends object>(
  endpoint: string,
  formData: T,
  errors: ReturnType<typeof ref<any>>
) => {
  try {
    errors.value = {};
    const response = await axios.post(endpoint, formData);

    return response.data;
  } catch (error: any) {
    if (error.response && error.response.status === 422) {
      console.log(errors.value);
      Object.keys(error.response.data.errors).forEach((key) => {
        errors.value[key] = error.response.data.errors[key][0];
      });
    } else {
      console.error("Request failed:", error);
    }
  }
};
