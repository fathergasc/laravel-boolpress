<template>
    <div class="container">
        <h1>Contact us</h1>

        <div v-if="success == true" class="alert alert-success" role="alert">Mail sent!</div>

        <form @submit.prevent="sendEmail">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" v-model="email" :class="errors.email?'is-invalid':''"/>

                <div class="invalid-feedback" v-for="(error, index) in errors.email" :key="index">
                    {{ error }}
                </div>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name"  v-model="name" :class="errors.name?'is-invalid':''"/>

                <div class="invalid-feedback" v-for="(error, index) in errors.name" :key="index">
                    {{ error }}
                </div>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" rows="3"  v-model="message" :class="errors.message?'is-invalid':''"></textarea>

                <div class="invalid-feedback" v-for="(error, index) in errors.message" :key="index">
                    {{ error }}
                </div>
            </div>
            <button v-if="sendingMail == false" type="submit"  class="btn btn-primary">Send</button>  <!--    :disabled="sendingMail"    - to disable the button through bootstrap when sendingMail is true -->
            <div v-else class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: 'ContactUsPage',
    data() {
        return {
            name: '',
            email: '',
            message: '',
            errors: {},
            success: false,
            sendingMail: false
        }
    },
    methods: {
        sendEmail() {

            this.sendingMail = true;

            axios.post('/api/contact', {
                        'name': this.name,
                        'email': this.email,
                        'message': this.message,
            })
            .then((response) => {

                this.success = response.data.success;  //to allow displaying "mail sent" alert
                this.sendingMail = false;

                if(this.success) {
                    this.errors = {}; //to remove the alert when you submit correct data after a failed validation
                    this.email = '';
                    this.message = '';
                    this.name = '';

                } else  {
                    this.errors = response.data.errors
                }
            })
        }
    }
}
</script>

<style></style>
