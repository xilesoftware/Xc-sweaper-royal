<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Player settings</div>

                    <div class="card-body">
                        <div v-if="message.length > 0" class="alert alert-success" role="alert" v-text="message"></div>
                        <div class="col"></div>
                        <div class="col offset-md-4 mt-3">
                            <label for="color">Change chat color</label>
                            <input type="color"></div>
                        <div class="col-md-4 offset-md-4 mt-2">
                            <label for="changename">Change player name</label>
                            <input class="form-control" type="text" placeholder="Player name"></div>
                        <div class="col-md-4 offset-md-4 mt-3">
                            <label for="changename">Change password</label>
                            <input class="form-control" type="text" placeholder="Password"></div>
                        <div class="col-md-4 offset-md-4 mt-3">
                            <button type="button" class="btn btn-secondary">Save</button></div>
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

<style>

</style>