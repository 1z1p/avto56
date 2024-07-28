<template>
    <div class="v-progress">
        <h4 class="v-progress__min">0</h4>
        <div class="progress">
            <progress max="100" value="1"></progress>
            <div class="progress-value"></div>
            <div class="progress-bg"><div class="progress-bar" :style="progress"></div></div>
        </div>
        <h4 class="v-progress__max">28</h4>
    </div>
</template>

<script>

export default {
    props: {
        value: Number
    },

    computed: {
        progress() {
            return {
                width: `${this.value}%`
            };
        }
    },
}

</script>

<style scoped>
.v-progress__min, .v-progress__max {
    position: absolute;
    top: -20px;
}
.v-progress__max {
    right: 0px;
}

.v-progress {
    margin-top: 25px;
    display: flex;
    width: 200px;
    justify-content: space-between;
    align-items: flex-start;
    position: relative;
}

.progress
{
  font: 12px Arial, Tahoma, sans-serif;
  position: relative;
  overflow: hidden;
  width: 250px;
}

.progress progress
{
  position: absolute;
  width: 0;
  height: 0;
  overflow: hidden;
  left: -777px;
}

.progress-bar
{
  overflow: hidden;
  background: #c3c3c3;
  width: 0;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
}

.progress-value
{
  color: #333;
  display: block;
  line-height: 21px;
  text-align: center;
}

.progress-bg
{
  background: #e6e9ed;
  position: relative;
  height: 8px;
  border-radius: 5px;
  overflow: hidden;
}

.progress-bar:after
{
  background-image: -webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
  background-image: -o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
  background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
  -webkit-background-size: 40px 40px;
  background-size: 40px 40px;
  position: absolute;
  content: '';
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

@keyframes progress_bar {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: -40px 0;
  }
}

.progress-bar
{
  transition: width 1s linear;
}

.progress-bar:after
{
  animation: progress_bar 0.8s linear infinite;
}

</style>