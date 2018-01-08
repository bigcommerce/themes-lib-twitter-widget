<template>
  <div>
    <h2 class="section-title">You may be interested in...</h2>
    <div class="cross-promo-container">
      <div class="cross-promo container" v-on:click="toggle(index)" v-for="(item, index) in promos">
        <div class="cross-promo-image">
          <img
            :src="item.img"
            :alt="item.title"
          />
        </div>
        <div class="cross-promo-text">
            <h3 class="cross-promo-title">{{item.title}}</h3>
          <div class="cross-promo-description">{{item.description}}</div>
        </div>
        <a
          :href="item.link"
          target="_blank"
          class="button button-tertiary cross-promo-button"
        >
          Learn More
        </a>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['promos']
  }
</script>
