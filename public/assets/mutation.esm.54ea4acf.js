import{w as G,v as P,a as S,c as O,b as F}from"./utils.esm.429db25b.js";const k=console;class D{destroy(){this.clearGcTimeout()}scheduleGc(){this.clearGcTimeout(),G(this.cacheTime)&&(this.gcTimeout=setTimeout(()=>{this.optionalRemove()},this.cacheTime))}updateCacheTime(t){this.cacheTime=Math.max(this.cacheTime||0,t!=null?t:P?1/0:5*60*1e3)}clearGcTimeout(){this.gcTimeout&&(clearTimeout(this.gcTimeout),this.gcTimeout=void 0)}}class j extends D{constructor(t){super(),this.defaultOptions=t.defaultOptions,this.mutationId=t.mutationId,this.mutationCache=t.mutationCache,this.logger=t.logger||k,this.observers=[],this.state=t.state||I(),this.setOptions(t.options),this.scheduleGc()}setOptions(t){this.options={...this.defaultOptions,...t},this.updateCacheTime(this.options.cacheTime)}get meta(){return this.options.meta}setState(t){this.dispatch({type:"setState",state:t})}addObserver(t){this.observers.includes(t)||(this.observers.push(t),this.clearGcTimeout(),this.mutationCache.notify({type:"observerAdded",mutation:this,observer:t}))}removeObserver(t){this.observers=this.observers.filter(i=>i!==t),this.scheduleGc(),this.mutationCache.notify({type:"observerRemoved",mutation:this,observer:t})}optionalRemove(){this.observers.length||(this.state.status==="loading"?this.scheduleGc():this.mutationCache.remove(this))}continue(){var t,i;return(t=(i=this.retryer)==null?void 0:i.continue())!=null?t:this.execute()}async execute(){const t=()=>{var e;return this.retryer=O({fn:()=>this.options.mutationFn?this.options.mutationFn(this.state.variables):Promise.reject("No mutationFn found"),onFail:(a,M)=>{this.dispatch({type:"failed",failureCount:a,error:M})},onPause:()=>{this.dispatch({type:"pause"})},onContinue:()=>{this.dispatch({type:"continue"})},retry:(e=this.options.retry)!=null?e:0,retryDelay:this.options.retryDelay,networkMode:this.options.networkMode}),this.retryer.promise},i=this.state.status==="loading";try{var s,r,o,n,l,u,h,c;if(!i){var d,f,v,p;this.dispatch({type:"loading",variables:this.options.variables}),await((d=(f=this.mutationCache.config).onMutate)==null?void 0:d.call(f,this.state.variables,this));const a=await((v=(p=this.options).onMutate)==null?void 0:v.call(p,this.state.variables));a!==this.state.context&&this.dispatch({type:"loading",context:a,variables:this.state.variables})}const e=await t();return await((s=(r=this.mutationCache.config).onSuccess)==null?void 0:s.call(r,e,this.state.variables,this.state.context,this)),await((o=(n=this.options).onSuccess)==null?void 0:o.call(n,e,this.state.variables,this.state.context)),await((l=(u=this.mutationCache.config).onSettled)==null?void 0:l.call(u,e,null,this.state.variables,this.state.context,this)),await((h=(c=this.options).onSettled)==null?void 0:h.call(c,e,null,this.state.variables,this.state.context)),this.dispatch({type:"success",data:e}),e}catch(e){try{var m,y,b,g,x,T,w,R;throw await((m=(y=this.mutationCache.config).onError)==null?void 0:m.call(y,e,this.state.variables,this.state.context,this)),await((b=(g=this.options).onError)==null?void 0:b.call(g,e,this.state.variables,this.state.context)),await((x=(T=this.mutationCache.config).onSettled)==null?void 0:x.call(T,void 0,e,this.state.variables,this.state.context,this)),await((w=(R=this.options).onSettled)==null?void 0:w.call(R,void 0,e,this.state.variables,this.state.context)),e}finally{this.dispatch({type:"error",error:e})}}}dispatch(t){const i=s=>{switch(t.type){case"failed":return{...s,failureCount:t.failureCount,failureReason:t.error};case"pause":return{...s,isPaused:!0};case"continue":return{...s,isPaused:!1};case"loading":return{...s,context:t.context,data:void 0,failureCount:0,failureReason:null,error:null,isPaused:!F(this.options.networkMode),status:"loading",variables:t.variables};case"success":return{...s,data:t.data,failureCount:0,failureReason:null,error:null,status:"success",isPaused:!1};case"error":return{...s,data:void 0,error:t.error,failureCount:s.failureCount+1,failureReason:t.error,isPaused:!1,status:"error"};case"setState":return{...s,...t.state}}};this.state=i(this.state),S.batch(()=>{this.observers.forEach(s=>{s.onMutationUpdate(t)}),this.mutationCache.notify({mutation:this,type:"updated",action:t})})}}function I(){return{context:void 0,data:void 0,error:null,failureCount:0,failureReason:null,isPaused:!1,status:"idle",variables:void 0}}export{j as M,D as R,k as d,I as g};