<template>
  <div>
    <h2 class="section-title">Frequently Asked Questions</h2>
    <div class="faq-container container">
      <div class="faq-question" v-on:click="toggle(index)" v-for="(item, index) in faqs">
        <div class="faq-description">{{item.title}}<div class="faq-arrow"></div></div>
        <div class="faq-content" style="display: none;">
          <p>{{item.msg}}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['faqs'],
  methods: {
    toggle: function (num) {
      this.questions = this.$el.children[1].children;

      if (this.questions[num].classList.contains('open')) {
        this.questions[num].classList.remove('open');
        this.questions[num].querySelectorAll('.faq-content')[0].style.display = 'none';
      } else {
        var prevFaqQuestion = this.$el.querySelectorAll('.open');
        if (prevFaqQuestion.length !== 0) {
          prevFaqQuestion[0].classList.remove('open');
          prevFaqQuestion[0].querySelectorAll('.faq-content')[0].style.display = 'none';
        }
        this.questions[num].classList.add('open');
        this.questions[num].querySelectorAll('.faq-content')[0].style.display = '';
      }
    },
  },
}
</script>
