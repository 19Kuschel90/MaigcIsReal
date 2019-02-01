<template>
  <div>

                 <p>ID: {{ monster.id }} </p>
                <p>Name: {{ monster.name }}</p>
                  <p>Img Name: {{ monster.imgName }}</p>
                  <p>AP: {{ monster.AP }}</p>
                  <p>DP: {{ monster.DP }}</p>
                  <p>HP: {{ monster.HP }}</p>
                  <p>Speed: {{ monster.Speed }}</p>
                  <p>SpwanWert: {{ monster.SpwanWert }}</p>
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
