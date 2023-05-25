<template>
  <div class="error">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-md-10 d-flex justify-content-center">
          <section class="page_404">
            <div class="container">
              <div class="row">
                <div class="col-sm-12">
                  <div class="col-sm-offset-1 text-center">
                    <div class="four_zero_four_bg"></div>

                    <div class="contant_box_404 mt-4">
                      <h3 class="h2">Look like you're lost</h3>

                      <p>the page you are looking for not avaible</p>

                      <div class="btn-box w-100 mt-4 mb-1">
                        <router-link
                          class="btn mb-2 btn-lg text-white"
                          style="background-color: #a1484d; border-radius: 50px"
                          :to="{ name: 'home' }"
                          ><span>Go to Home Page</span>
                        </router-link>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "error404",
  components: {},
};
</script>
<style>
.error .page_404 {
  padding: 40px 0;
  width: 100%;
  background: #fff;
  font-family: "Arvo", serif;
}

.error .page_404 img {
  width: 100%;
}

.error .four_zero_four_bg {
  background-image: url("@/assets/animations/404.gif");
  height: 500px;
  background-size: contain;
  background-position: center;
  background-repeat: no-repeat;
}

.error .four_zero_four_bg h1 {
  font-size: 80px;
}

.error .four_zero_four_bg h3 {
  font-size: 80px;
}

.error .link_404 {
  color: #fff !important;
  padding: 10px 20px;
  background: #39ac31;
  margin: 20px 0;
  display: inline-block;
}
.error .contant_box_404 {
  margin-top: -50px;
}
/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
  .error .four_zero_four_bg {
    background-image: url("@/assets/animations/404.gif");
    height: 300px;
    background-size: cover;
    background-position: center;
  }
}
</style>
