import axios from "axios";

export const submitForm = async(
    endpoint: string,
    formData: any,
    errors: any
) => {
    try {
        errors.value = {};

        const response = await axios.post(endpoint, formData);

        return response.data;

    } catch (error: any) {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors;
        } else {
            console.error('Request failed:', error);
        }
    }
};