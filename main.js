var app = new Vue({
  el: '#app',
  data: {
    user: {
      name: '',
      username: '',
      password: '',
      confirm_password: '',
      rol: ''
    },
    error: ''
  },

  methods: {
    login: function(){
      axios({
        method: 'POST',
        url: '/habilitacion/conection.php',
        data: this.user,
        responseType: 'json'
      }).then(response => {
        if (response.data.error) {
          this.error = response.data.message
        } else {
          location.href = '/habilitacion/index.php'
        }
      })
        .catch(console.error)
    },
    register: function(){
      axios({
        method: 'POST',
        url: '/habilitacion/conection-register.php',
        data: this.user,
        responseType: 'json'
      }).then(response => {
        if (response.data.error) {
          this.error = response.data.message
        } else {
          location.href = '/habilitacion/login.php'
        }
      })
        .catch(console.error)
    },
    
  }
})
