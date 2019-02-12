<template>
  <div>

                <img v-bind:src="'img/'+ monster.imgName" class="rounded float-right w-25" alt="Monster">
                 <p>ID: {{ monster.id }} </p>
                <p>Name: {{ monster.name }}</p>
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
