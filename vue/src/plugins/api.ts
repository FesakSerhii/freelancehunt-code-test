import {Axios} from "axios";
import type {App} from "vue";

declare const globalContext: any;

export class API {
    constructor(private $axios: Axios, private requestStore: any) {}

    get<T = any>(endpoint: string, data: any = {}): Promise<T> {
        let url = endpoint;
        let filledKeys = Object.keys(data).filter(key => !!data[key]);
        if (filledKeys.length > 0) {
            url += (url.includes("?") ? "&" : "?") + filledKeys.map(k => `${k}=${encodeURIComponent(data[k])}`).join("&");
        }
        if (!import.meta.env.SSR && globalContext[url]) {
            const data: any = globalContext[url];
            delete globalContext[url];
            return Promise.resolve(data);
        }

        return this.$axios.get(url).then(resp => {
            if (import.meta.env.SSR) {
                this.requestStore[url] = resp.data;
            }
            return resp.data
        }).catch(e => console.log(e));
    }
}

export default {
    install(app: App, options: any) {
        let api = new API(options.axios, options.requestStore);
        app.provide("api", api);
        app.config.globalProperties.$api = api;
    },
}
