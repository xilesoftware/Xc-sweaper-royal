<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Lobby</div>

                    <div class="card-body">
                        <div v-if="message.length > 0" class="alert alert-success" role="alert" v-text="message"></div>
                        You are in the lobby
                        <input name="message" v-model="playerMessage" class="form-control" />
                        <button class="btn btn-primary" @click.prevent="sendMessage">Send</button>
                        <p v-for="(msg, index) in messages" :key="index" v-text="msg"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data:() => ({
            message: '',
            messages: [],
            playerMessage: '',
        }),

        methods: {
            createMessageChanel() {
                window.Echo.channel('messages')
                    .listen('.send-message', (e) => {
                        this.messages.push(e.message);
                        console.log(e, e.message);
                    });
            },

            sendMessage() {
                axios.post('/message', {
                    message: this.playerMessage
                }).then(() => {
                    this.playerMessage = '';
                });
            }
        },
        
        mounted() {
            this.createMessageChanel();
            // console.log('Component mounted.')
        }
    }
</script>
