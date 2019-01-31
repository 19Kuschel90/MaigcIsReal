<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <div>
                          <div>Name:<input v-model="Monster['name']"></div>
                          <div>imgName:<input v-model="Monster['imgName']"></div>
                          <div>AP:<input v-model="Monster['AP']"></div>
                          <div>DP:<input v-model="Monster['DP']"></div>
                          <div>Speed:<input v-model="Monster['Speed']"></div>
                          <div>SpwanWert:<input v-model="Monster['SpwanWert']"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
         data() {
            return {
                Monster:{
                    name: '',
                    imgName: '',
                    AP: -1,
                    DP: -1,
                    Speed: -1,
                    SpwanWert: -1,
                },

            };
        },
    }
</script>
