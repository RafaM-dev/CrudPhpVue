let app = new Vue({
  el: '#app',
  data: {
    user: {
      id: '',
      name: '',
      username: '',
      rol:'',
    },
    userId: '',
    users: [],
    error: '',
    show: false
  },

  mounted: function(){
    this.fetchUsers();
  },

  methods: {
    fetchUsers: async function(){
      const response = await axios({
        method: 'GET',
        url: '/habilitacion/crud.php',
      });

      this.users = response.data;
    },
    deleteUser: async function(id){
      const response = await axios({
        method: 'DELETE',
        url: '/habilitacion/crud.php',
        data: {id}
      })

      if (!response.data.error){
        this.fetchUsers();
      }
    },
    editUser: async function(){
      const response = await axios({
        method: 'POST',
        url: '/habilitacion/crud.php',
        data: this.user,
        responseType: 'json'
      })


      window.location = 'index.php'
      this.user = {};
    },

    showModal: function(id){
      const userIndex = this.users.findIndex(eachUser => eachUser.id === id);
      this.user = this.users[userIndex];
    },

    generatePdf: function(){
      const doc = new jsPDF();
      let i = 30;
      doc.setFont("helvetica", "bold");
      doc.setFontSize(12);
      doc.text("Usuarios", 100, 10)
      doc.text("Username      Name         Password", 1, 20)

      doc.setFont("helvetica", "normal");
      this.users.forEach(user => {
        doc.text(`${user.username}       ${user.name}            ${user.password}`, 1, i);
        i += 10;
      })

      doc.save("a4.pdf");
    },
    
    generateXls: function(){
      let headers = [
          { label: 'ID', field: 'id' },
          { label: 'Nombre', field: 'name' },
          { label: 'Usuario', field: 'username' },
          { label: 'Contraseña', field: 'password' },
      ];

      content = toExcel.exportXLS( headers, this.users, 'users' );

    }
  }
})
