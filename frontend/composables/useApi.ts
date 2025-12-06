export const useApi = () => {
    const config = useRuntimeConfig()
    
    const fetchData = async (endpoint: string) => {
        return await $fetch(`${config.public.apiBase}/${endpoint}`)
    }
    
    return { fetchData }
}