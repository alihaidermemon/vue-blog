<template>
  <div class="container">
    <div class="loading-wrapper" v-show="isLoader">
      <div class="loader2"></div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">All Blog</div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <label
                  >Show
                  <select
                    name="length"
                    @change="getByPaginationAndSearch()"
                    v-model="perPage"
                  >
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                  </select>
                  entries
                </label>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input
                    type="text"
                    placeholder="Search Data"
                    v-model="query"
                    @keyup="getByPaginationAndSearch()"
                    class="form-control"
                  />
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="blog in blogs.data" v-bind:key="blog.id">
                    <td>{{ blog.id }}</td>
                    <td>{{ blog.title }}</td>
                    <td>{{ blog.short_description }}</td>
                    <td>{{ blog.created_at | formatDateTime }}</td>
                    <td>
                      <div class="btn-group" role="group">
                        <button
                          @click="editBlog(blog.id)"
                          class="btn btn-primary"
                        >
                          Edit
                        </button>
                        <button
                          class="btn btn-danger"
                          @click="deleteBlog(blog.id)"
                        >
                          Delete
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-md-4">
                Showing {{ blogs.from }} to {{ blogs.to }} of
                {{ blogs.total }} entries
              </div>
              <div class="col-md-8">
                <div class="pull-right">
                  <pagination
                    :data="blogs"
                    @pagination-change-page="getByPaginationAndSearch"
                  ></pagination>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
 
<script>
const vm = this;
export default {
  data() {
    return {
      perPage: 10,
      query: "",
      blogs: {},
      isLoader: true,
    };
  },
  created() {
    this.blogList();
  },
  methods: {
    blogList() {
      this.axios.get("/api/blog/list?perPage=10").then((response) => {
        this.blogs = response.data.data;
        setTimeout(() => (this.isLoader = false), 500);
      });
    },
    getByPaginationAndSearch(page) {
      console.log(page);
      if (page === undefined) {
        page = 1;
      }
      this.axios
        .get(
          "/api/blog/list?perPage=10&perPage=" +
            this.perPage +
            "&page=" +
            page +
            "&search=" +
            this.query
        )
        .then((response) => {
          console.log(response.data.data);
          this.blogs = response.data.data;
          setTimeout(() => (this.isLoader = false), 500);
        });
    },
    editBlog(id) {
      vm.$router.push("blog/edit/" + id);
    },
    deleteBlog(id) {
      var data = {
        id: id,
      };
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.axios
            .post("/api/blog/delete", data)
            .then(function (response) {
              if (response.data.success) {
                sweetAlertToastr("success", response.data.message);
              } else {
                sweetAlertToastr(
                  "error",
                  "Something Went Wrong! Please try again later."
                );
              }
            })
            .catch((error) => {
              // console.log(error);
              sweetAlertToastr(
                "error",
                "Something Went Wrong! Please try again later."
              );
            });
          this.blogs = {};
          this.isLoader = true;
          setTimeout(() => {
            this.blogList();
          }, 1000);
        } else {
          return false;
        }
      });
    },
  },
};
</script>