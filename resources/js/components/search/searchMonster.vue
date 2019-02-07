<template>
    <div class="container">

         <div> Monsters
             <div v-if="monster.length != 0 && monster[0].id != -1">

     <table class="table">

  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Name</th>
      <th scope="col">Img Name</th>
      <th scope="col">HP</th>
      <th scope="col">AP</th>
      <th scope="col">DP</th>
      <th scope="col">Speed</th>
      <th scope="col">Spwan Wert</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="value in monster ">
      <th scope="row" >{{ value.id }}</th>
      <th scope="row" >{{ value.name }}</th>
      <th scope="row" >{{ value.imgName }}</th>
      <th scope="row" >{{ value.HP }}</th>
      <th scope="row" >{{ value.AP }}</th>
      <th scope="row" >{{ value.DP }}</th>
      <th scope="row" >{{ value.Speed }}</th>
      <th scope="row" >{{ value.SpwanWert }}</th>
    </tr>

  </tbody>
</table>
             </div>
             <div v-else>
                 Not Moster Found
             </div>
         </div>
    </div>
</template>

<script>

    export default {
        mounted() {
            console.log('Component mounted searchMonster.');

        },
   props: ["monster"],
created() {
            // For adding the token to axios header (add this only one time).

        },


    }

</script>
