<template>
  <div>
      <div>
                             <p>ID: {{userData.id }}</p>
  <p>Name: {{ userData.name }}</p>
                             <p>E-maiddddl: {{userData.email }}</p>
  </div>
  </div>
</template>
 
<script>
    export default {
        mounted() {
            console.log('Edit.');
        }, 

    
         props: ["userData"],

    }
    
</script>