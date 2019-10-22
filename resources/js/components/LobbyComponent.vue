<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Lobby</div>

                    <div class="card-body">
                        <div v-if="message.length > 0" class="alert alert-success" role="alert" v-text="message"></div>
                        You are in the lobby
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data:() => ({
            message: ''
        }),
        
        mounted() {
            // console.log('Component mounted.')
        }
    }
</script>
