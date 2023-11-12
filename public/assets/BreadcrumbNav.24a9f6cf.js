import{j as h,aF as S,aG as B,c as i,h as l,ao as C,p as Q,aX as E,aY as $,a3 as w,k as z,v as N,q as b,s as p,A as f,aa as A,d as v,t as g,aZ as P,F as V,ar as F,z as L}from"./index.16fafb50.js";var _=h({name:"QBreadcrumbsEl",props:{...S,label:String,icon:String,tag:{type:String,default:"span"}},emits:["click"],setup(e,{slots:a}){const{linkTag:o,linkAttrs:c,linkClass:s,navigateOnClick:d}=B(),n=i(()=>({class:"q-breadcrumbs__el q-link flex inline items-center relative-position "+(e.disable!==!0?"q-link--focusable"+s.value:"q-breadcrumbs__el--disable"),...c.value,onClick:d})),u=i(()=>"q-breadcrumbs__el-icon"+(e.label!==void 0?" q-breadcrumbs__el-icon--with-label":""));return()=>{const r=[];return e.icon!==void 0&&r.push(l(C,{class:u.value,name:e.icon})),e.label!==void 0&&r.push(e.label),l(o.value,{...n.value},Q(a.default,r))}}});const T=["",!0];var j=h({name:"QBreadcrumbs",props:{...E,separator:{type:String,default:"/"},separatorColor:String,activeColor:{type:String,default:"primary"},gutter:{type:String,validator:e=>["none","xs","sm","md","lg","xl"].includes(e),default:"sm"}},setup(e,{slots:a}){const o=$(e),c=i(()=>`flex items-center ${o.value}${e.gutter==="none"?"":` q-gutter-${e.gutter}`}`),s=i(()=>e.separatorColor?` text-${e.separatorColor}`:""),d=i(()=>` text-${e.activeColor}`);return()=>{const n=w(z(a.default));if(n.length===0)return;let u=1;const r=[],k=n.filter(t=>t.type!==void 0&&t.type.name==="QBreadcrumbsEl").length,y=a.separator!==void 0?a.separator:()=>e.separator;return n.forEach(t=>{if(t.type!==void 0&&t.type.name==="QBreadcrumbsEl"){const m=u<k,q=t.props!==null&&T.includes(t.props.disable),x=(m===!0?"":" q-breadcrumbs--last")+(q!==!0&&m===!0?d.value:"");u++,r.push(l("div",{class:`flex items-center${x}`},[t])),m===!0&&r.push(l("div",{class:"q-breadcrumbs__separator"+s.value},y()))}else r.push(t)}),l("div",{class:"q-breadcrumbs"},[l("div",{class:c.value},r)])}}});const R={class:"flex justify-between items-center"},D={class:"fontsize-16"},G={class:"q-pa-md q-gutter-sm"},M=N({__name:"BreadcrumbNav",props:{titlePage:{default:""},pages:{},activeColor:{default:"secondary"},colorText:{default:"info"},separator:{default:"arrow_forward"},colorSeparatpr:{}},setup(e){const a=e;return(o,c)=>(b(),p("div",R,[f("div",D,A(a.titlePage),1),f("div",G,[v(j,{"active-color":a.activeColor,class:P(a.colorText)},{separator:g(()=>[v(C,{size:"1.5em",name:"chevron_right",color:o.colorSeparatpr},null,8,["color"])]),default:g(()=>[v(_,{icon:"analytics",to:{name:"dashboard-home"}}),(b(!0),p(V,null,F(a.pages,s=>(b(),L(_,{key:s.label,label:s.label,icon:s.icon,to:{name:s.to}},null,8,["label","icon","to"]))),128))]),_:1},8,["active-color","class"])])]))}});export{M as _};
