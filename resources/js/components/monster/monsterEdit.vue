<template>
  <div>
                 <div>Name:<input v-model="monster['name']"></div>
                          <div>imgName:<input v-model="monster['imgName']"></div>
                          <div>AP:<input v-model="monster['AP']"></div>
                          <div>DP:<input v-model="monster['DP']"></div>
                          <div>Speed:<input v-model="monster['Speed']"></div>
                          <div>SpwanWert:<input v-model="monster['SpwanWert']"></div>
  </div>
</template>

<script>
    export default {
        mounted() {
            console.log('monsterEdit.');
        },


        /**
         *   Monster:{
                    name: '',
                    imgName: '',
                    AP: -1,
                    DP: -1,
                    Speed: -1,
                    SpwanWert: -1,
                },
         */
         props: ["monster"],

    }

</script>
