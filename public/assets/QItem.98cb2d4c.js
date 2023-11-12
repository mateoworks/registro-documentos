import{j as f,c as n,h as o,k as x,aF as L,aG as S,r as d,aE as w,a0 as I,aw as K,g as Q}from"./index.16fafb50.js";import{u as R,a as j}from"./use-dark.fd3c0586.js";var D=f({name:"QItemSection",props:{avatar:Boolean,thumbnail:Boolean,side:Boolean,top:Boolean,noWrap:Boolean},setup(e,{slots:i}){const s=n(()=>`q-item__section column q-item__section--${e.avatar===!0||e.side===!0||e.thumbnail===!0?"side":"main"}`+(e.top===!0?" q-item__section--top justify-start":" justify-center")+(e.avatar===!0?" q-item__section--avatar":"")+(e.thumbnail===!0?" q-item__section--thumbnail":"")+(e.noWrap===!0?" q-item__section--nowrap":""));return()=>o("div",{class:s.value},x(i.default))}}),F=f({name:"QItem",props:{...R,...L,tag:{type:String,default:"div"},active:{type:Boolean,default:null},clickable:Boolean,dense:Boolean,insetLevel:Number,tabindex:[String,Number],focused:Boolean,manualFocus:Boolean},emits:["click","keyup"],setup(e,{slots:i,emit:s}){const{proxy:{$q:r}}=Q(),b=j(e,r),{hasLink:c,linkAttrs:q,linkClass:k,linkTag:y,navigateOnClick:g}=S(),u=d(null),l=d(null),v=n(()=>e.clickable===!0||c.value===!0||e.tag==="label"),a=n(()=>e.disable!==!0&&v.value===!0),h=n(()=>"q-item q-item-type row no-wrap"+(e.dense===!0?" q-item--dense":"")+(b.value===!0?" q-item--dark":"")+(c.value===!0&&e.active===null?k.value:e.active===!0?` q-item--active${e.activeClass!==void 0?` ${e.activeClass}`:""}`:"")+(e.disable===!0?" disabled":"")+(a.value===!0?" q-item--clickable q-link cursor-pointer "+(e.manualFocus===!0?"q-manual-focusable":"q-focusable q-hoverable")+(e.focused===!0?" q-manual-focusable--focused":""):"")),_=n(()=>{if(e.insetLevel===void 0)return null;const t=r.lang.rtl===!0?"Right":"Left";return{["padding"+t]:16+e.insetLevel*56+"px"}});function B(t){a.value===!0&&(l.value!==null&&(t.qKeyEvent!==!0&&document.activeElement===u.value?l.value.focus():document.activeElement===l.value&&u.value.focus()),g(t))}function C(t){if(a.value===!0&&w(t,13)===!0){I(t),t.qKeyEvent=!0;const m=new MouseEvent("click",t);m.qKeyEvent=!0,u.value.dispatchEvent(m)}s("keyup",t)}function E(){const t=K(i.default,[]);return a.value===!0&&t.unshift(o("div",{class:"q-focus-helper",tabindex:-1,ref:l})),t}return()=>{const t={ref:u,class:h.value,style:_.value,role:"listitem",onClick:B,onKeyup:C};return a.value===!0?(t.tabindex=e.tabindex||"0",Object.assign(t,q.value)):v.value===!0&&(t["aria-disabled"]="true"),o(y.value,t,E())}}});export{F as Q,D as a};
