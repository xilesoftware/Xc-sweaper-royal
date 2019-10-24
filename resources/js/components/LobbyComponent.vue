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
                        <p v-for="(msg, index) in messages" :key="index">{{ msg.timestamp }} - {{ msg.username }}: {{ msg.message }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        data:() => ({
            message: '',
            messages: [],
            playerMessage: '',
        }),

        computed: {
            user() {
                return this.$store.state.user;
            }
        },

        methods: {
            createMessageChanel() {
                window.Echo.channel('messages')
                    .listen('.send-message', (e) => {
                        let data = {
                            timestamp: moment().format('HH:mm:ss'),
                            message: e.message,
                            username: this.user.username
                        }
                        this.messages.push(data);
                        console.log(e, data);
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
