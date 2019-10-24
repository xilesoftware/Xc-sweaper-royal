<template>
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-10 game-board">
                <div class="map">
                    <div v-for="y in Object.keys(map).length" :key="y" class="map-row">
                        <div v-for="x in Object.keys(y).length" :key="x" class="cell valid-move">
                            <!-- {{ row }} <br> {{ cell }} -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 player-list">
                <ul>
                    <li>P1</li>
                    <li>P2</li>
                </ul>
            </div>
        </div>
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
            map: {
                x: 25,
                y: 25
            },
        }),

        computed: {
            user() {
                return this.$store.state.user;
            }
        },
        
        created(){
            let map = {};
            for(let y = 0; y < this.map.y; y++){
                map[y] = {}
                for(let x = 0; x < this.map.x; x++){
                    map[y][x] = {
                        type: 'unknown'
                    }
                }
            }

            console.log(map);
            console.log(Object.keys(map).length);
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

<style>
    .game-board{
        background: #f00;
    }
    .player-list{
        background: #0f0;
    }

    :root {
        --columns: 50;
        --rows: 25;
        --grid-gap: 2px;
    }

    .map{
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: repeat(var(--rows), 20px);
        background: #ccc;
        /* width: calc(1000px + var(--grid-gap) * var(--columns) - var(--grid-gap)); */
        /* height: calc(500px + var(--grid-gap) * var(--rows) - var(--grid-gap));; */
        width: 100%;
        grid-gap: var(--grid-gap);
        border: 2px solid #ccc;
    }
    .map .map-row{
        display: grid;
        grid-template-columns: repeat(var(--columns), 20px);
        grid-template-rows: 1fr;
        grid-gap: var(--grid-gap);
    }
    .cell{
        background: #eee;
        width: 20px;
        height: 20px;
        display: grid;
        place-items: center;
        color: #aaa;
        user-select: none;
        font-size: 8px;
        font-family: Monospace;
        text-align: center;
        line-height: 8px;
    }
    .cell:hover{
        background: #ddd;
    }
    .cell.valid-move:hover{
        cursor: pointer;
    }
</style>