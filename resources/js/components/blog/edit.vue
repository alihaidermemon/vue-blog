<template>
  <div>
    <div class="container">
      <div class="loading-wrapper" v-show="isLoader">
        <div class="loader2"></div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">Edit Blog</div>
            <div class="card-body">
              <form ref="form" @submit.prevent="blogUpdate">
                <div class="form-group row">
                  <label
                    for="title"
                    class="col-md-2 col-form-label text-md-right"
                    >Title</label
                  >
                  <div class="col-md-9">
                    <input
                      type="text"
                      id="title"
                      class="form-control"
                      v-model="blog.title"
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label
                    for="slug"
                    class="col-md-2 col-form-label text-md-right"
                    >Slug</label
                  >
                  <div class="col-md-9">
                    <input
                      type="text"
                      id="slug"
                      class="form-control"
                      v-model="blog.slug"
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label
                    for="description"
                    class="col-md-2 col-form-label text-md-right"
                    >Description</label
                  >
                  <div class="col-md-9">
                    <ckeditor
                      id="description"
                      v-model="blog.description"
                    ></ckeditor>
                  </div>
                </div>
                <div class="col-md-12 text-center">
                  <input
                    type="hidden"
                    id="id"
                    class="form-control"
                    v-model="blog.id"
                  />
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      blog: {},
      isLoader: true,
    };
  },
  mounted() {
    this.blogGet();
    setTimeout(() => (this.isLoader = false), 500);
  },
  methods: {
    blogGet() {
      const vm = this;
      var id = vm.$route.params.id;
      if (id !== undefined) {
        this.axios
          .get("/api/blog/get?id=" + id)
          .then((response) => {
            this.blog = response.data.data.blog;
            CKEDITOR.instances.editor.setData(
              response.data.data.blog.description
            );
            console.log(response.data);
          })
          .catch((error) => {
            // console.log(error.response.data);
            if (error.response.data !== undefined) {
              sweetAlertToastr("error", error.response.data.message);
              setTimeout(() => {
                vm.$router.push("/");
              }, 2000);
            } else {
              sweetAlertToastr(
                "error",
                "Something Went Wrong! Please try again later."
              );
            }
          });
      } else {
        vm.$router.push("/");
      }
    },
    blogUpdate() {
      const vm = this;
      this.isLoader = true;

      this.axios
        .post("/api/blog/update", this.blog)
        .then(function (response) {
          if (response.data.success) {
            sweetAlertToastr("success", response.data.message);

            setTimeout(() => {
              vm.$router.push("/");
            }, 2000);
          } else {
            sweetAlertToastr(
              "error",
              "Something Went Wrong! Please try again later."
            );
          }
        })
        .catch((error) => {
          // console.log(error.response.data);
          if (error.response.data !== undefined) {
            sweetAlertToastr("error", error.response.data.message);
          } else {
            sweetAlertToastr(
              "error",
              "Something Went Wrong! Please try again later."
            );
          }
        });
      setTimeout(() => (this.isLoader = false), 50);
    },
  },
};
</script>