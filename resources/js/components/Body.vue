<template>
    <div id="body">
       <LeftBody />
       <RightBody />
        <router-view></router-view>
    </div>
</template>

<script>
import LeftBody from "./LeftBody" ;
import RightBody from "./RightBody" ;

export default {

    components: {
        LeftBody,
        RightBody,
    }
};
</script>

<style>
    
</style>