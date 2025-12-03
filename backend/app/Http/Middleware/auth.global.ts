export default defineNuxtRouteMiddleware((to, from) => {
  const user = useState("user")

  if (process.client) {
    const savedUser = localStorage.getItem("user")
    if (savedUser) user.value = JSON.parse(savedUser)
  }
})
