export const useAuth = () => {
  const user = useState("user", () => null);

  const login = async (email, password) => {
    const { data, error } = await useFetch("http://127.0.0.1:8000/api/login", {
      method: "POST",
      body: { email, password },
      credentials: "include"
    });

    if (error.value) {
      throw error.value.data.message;
    }

    user.value = data.value.user;
  };

  return { user, login };
};
