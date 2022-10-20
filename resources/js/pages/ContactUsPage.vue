<template>
    <div class="container">
        <h1>Contact us</h1>
        <form @submit.prevent="sendEmail">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" v-model="email"/>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name"  v-model="name"/>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" rows="3"  v-model="message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
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
        }
    },
    methods: {
        sendEmail() {
            axios.post('/api/contact', {
                        'name': this.name,
                        'email': this.email,
                        'message': this.message,
            })
            .then((response) => {
                console.log(response);
            })
        }
    }
}
</script>

<style></style>
