<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/38693eec21.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <title>CRUD application</title>

    <!-- CSS Style -->
    <style>
#overlay{
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.678);
  }
    </style>
</head>
<body>
 <div id="app">

        <div class="container">
          <div class="row mt-3">
            <div class="col-lg-6">
              <button class="btn btn-primary" @click="showAddModal=true">
                <i class="fas fa-user"></i>&nbsp;&nbsp;Add New Users
              </button>
              
                            
            </div>
            <div class="col-lg-6">
            <a href="logout.php">
              <button class="btn btn-danger float-end">
              <i class="fas fa-user"></i>&nbsp;&nbsp;Log Out
              </button>
              </a>
            </div>
          </div>
          <hr class="bg-primary">
        <div class="alert alert-danger" v-if="errorMsg">
          {{ errorMsg }}
        </div>
        <div class="alert alert-success" v-if="successMsg">
        {{ successMsg }}
        </div>

        <!-- Displaying Records -->

        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered table-striped">
              <thead>
                <tr class="text-center bg-primary text-light">
                  <th>ID</th>
                  <th>Fist Name</th>
                  <th>Last Name</th>
                  <th>Phone Number</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr class="text-center" v-for="user in users">
                <td>{{ user.ID }}</td>
                <td>{{ user.FirstName }}</td>
                <td>{{ user.LastName }}</td>
                <td>{{ user.PhoneNumber }}</td>
                <td>{{ user.Email }}</td>
                <td>{{ user.Password }}</td>
                <td><a href="#" class="text-success" @click="showEditModal=true; selectUser(user);"><i class="fas fa-user-edit"></i></a></td>
                <td><a href="#" class="text-danger" @click="showDeleteModal=true; selectUser(user);"><i class="fas fa-user-times"></i></a></td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>

        <button type="button" class="btn btn-primary float-end" style="margin: 5px;"><i class="fas fa-forward"></i></button>
        <button type="button" class="btn btn-primary float-end" style="margin: 5px;">1</button>
        <button type="button" class="btn btn-primary float-end" style="margin: 5px;"><i class="fas fa-backward"></i></button>
        

        <!-- Add New User -->
        <div id="overlay" v-if="showAddModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="text-primary"><i class="fas fa-user-plus"></i>&nbsp;Add User</h5><br>
                      <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close" @click="showAddModal=false"></button>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="#" class="row g-3">
                      
                      <div class="col-md-6">
                        <input type="text" name="FirstName" class="form-control" id="FirstName" placeholder="First Name" v-model="newUser.FirstName" required>
                      </div>
                      <div class="col-md-6">
                        <input type="text" name="LastName" class="form-control" id="LastName" placeholder="Last Name" v-model="newUser.LastName" required>
                      </div>
                      <div class="col-8">
                        <input type="tel" name="PhoneNumber" class="form-control" id="PhoneNumber" placeholder="Phone Number" v-model="newUser.PhoneNumber" required>
                      </div>
                      <div class="col-8">
                        <input type="email" name="Email" class="form-control" id="Email" placeholder="Email" v-model="newUser.Email" required>
                      </div>
                      <div class="col-8">
                        <input type="password" name="Password" class="form-control" id="Password" placeholder="Password" v-model="newUser.Password" required>
                      </div>
                      <div class="col-12">
                        <button type="submit" class="btn btn-primary" @click="showAddModal=false; addUser(); clearMsg();">Add</button>
                      </div>
                      </div>
                  
                     </form>
                  </div>
              </div>
           </div>
      </div>

      <!-- Delete User -->
      <div id="overlay" v-if="showDeleteModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="text-danger"><i class="fas fa-user-times"></i>&nbsp;Delete User</h5><br>
                      <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" 
                      aria-label="Close" @click="showDeleteModal=false"></button>
                  </div>

                  <div class="modal-body p-4">
                    
                      <h4 class="text-primary">Are you sur want to delete this user.?</h4>
                      <h5>You are deleting '{{ currentUser.FirstName }} {{ currentUser.LastName }}'</h5>
                      <hr>
                      <button class="btn btn-danger btn-lg" @click="showDeleteModal=false; deleteUser(); clearMsg();">Yes</button>
                      &nbsp;&nbsp;&nbsp;
                      <button class="btn btn-success btn-lg" @click="showDeleteModal=false">No</button>
                  </div>
              </div>
           </div>
      </div>

      <!-- Edit User -->
      <div id="overlay" v-if="showEditModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="text-primary"><i class="fas fa-user-plus"></i>Edit User</h5><br>
                      <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close" @click="showEditModal=false"></button>
                  </div>
                  <div class="modal-body">
                    <form action="#" class="row g-3">
                      
                      <div class="col-md-6">
                        <input type="text" class="form-control" id="FirstName" v-model="currentUser.FirstName">
                      </div>
                      <div class="col-md-6">
                        <input type="text" class="form-control" id="LastName" v-model="currentUser.LastName">
                      </div>
                      <div class="col-8">
                        <input type="tel" class="form-control" id="PhoneNumber" v-model="currentUser.PhoneNumber">
                      </div>
                      <div class="col-8">
                        <input type="email" class="form-control" id="Email" v-model="currentUser.Email">
                      </div>
                      <div class="col-8">
                        <input type="password" class="form-control" id="Password" v-model="currentUser.Password">
                      </div>
                      <div class="col-12">
                        <button type="submit" class="btn btn-primary" @click="showEditModal=false; updateUser(); clearMsg();">Update</button>
                      </div>
                      
                  </div>
                  
                     </form>
                  </div>
              </div>
           </div>
      </div>

      
        
 </div>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
   <script>
     var app = new Vue({
      el: '#app',
      data: {
          errorMsg: "",
          successMsg: "",
          showAddModal: false,
          showEditModal: false,
          showDeleteModal: false,
          action: "",
          users: [],
          newUser: {FirstName: "",LastName: "",PhoneNumber: "",Email: "",Password: ""},
          currenUser: {}    
      },
      mounted: function(){
        this.getAllUsers();
      },
      methods: {
        getAllUsers(){
          axios.get("http://localhost/crud/process.php?action=read").then(function(response){
            if(response.data.error){
              app.errorMsg = response.data.message;
            }
            else{
              app.users = response.data.users;
            }
          });
        },

        addUser(){
                  var formData=app.toFormData(app.newUser);
                  axios.post("http://localhost/crud/process.php?action=create", formData).then(function(response){
                      app.newUser = {FirstName:"", LastName:"", PhoneNumber:"", Email:"",Password: ""};
                      if(response.data.error){
                          app.errorMsg=response.data.message;
                      }
                      else{
                          app.successMsg = response.data.message;
                          app.getAllUsers();
                      }
                  });
              },

        updateUser(){
          var formData = app.toFormData(app.currentUser);
          axios.post("http://localhost/crud/process.php?action=update", formData).then(function(response){
            app.currentUser = {};
            if(response.data.error){
              app.errorMsg = response.data.message;
            }
            else{
              app.successMsg = response.data.message;
              app.getAllUsers();
            }
          });

        },

        deleteUser(){
          var formData = app.toFormData(app.currentUser);
          axios.post("http://localhost/crud/process.php?action=delete", formData).then(function(response){
            app.currentUser = {};
            if(response.data.error){
              app.errorMsg = response.data.message;
            }
            else{
              app.successMsg = response.data.message;
              app.getAllUsers();
            }
          });

        },

        toFormData(obj){
          var fd = new FormData();
          for(var i in obj){
            fd.append(i,obj[i]);
          }
          return fd;
        },
        selectUser(user){
          app.currentUser = user;
        },
        clearMsg(){
          app.errorMsg = "";
          app.successMsg = "";
        }
      }  
     });
   </script>
    
    
    
</body>
</html>