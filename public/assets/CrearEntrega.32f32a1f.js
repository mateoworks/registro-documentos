import{Q as s}from"./QPage.bd9db12d.js";import{_ as c}from"./FormEntrega.025e54a6.js";import{u}from"./useCrearRecurso.f4615a27.js";import{_ as d}from"./BreadcrumbNav.24a9f6cf.js";import{v as l,r as g,q as _,z as f,t as C,d as t,u as e}from"./index.16fafb50.js";import"./QBanner.f76ac382.js";import"./use-dark.fd3c0586.js";import"./QSelect.3768a279.js";import"./use-key-composition.749118dd.js";import"./uid.42677368.js";import"./focus-manager.05708ea9.js";import"./QChip.fc1367d4.js";import"./QItem.98cb2d4c.js";import"./QItemLabel.bb4f8a3f.js";import"./QMenu.ab6378a2.js";import"./selection.fb3d903a.js";import"./focusout.5c99f0fb.js";import"./QDialog.82b87909.js";import"./use-prevent-scroll.175dc396.js";import"./use-form.e491c393.js";import"./format.2bc25e5f.js";import"./QDate.75e05ac0.js";import"./use-cache.b0833c75.js";import"./date.eb8942c3.js";import"./QPopupProxy.2db034ac.js";import"./QInput.ec90feeb.js";import"./QFile.0d542f19.js";import"./QForm.5f43623c.js";import"./QCard.9550f461.js";import"./ClosePopup.159f4ab9.js";import"./errorUtils.9be85d5d.js";import"./useObtenerDocumentos.0e046498.js";import"./useRecursosMultiples.fa0015da.js";import"./documentosApi.d4af84c5.js";import"./axios.a596eead.js";import"./useQuery.esm.48506497.js";import"./useQueryClient.esm.ad4fb503.js";import"./utils.esm.429db25b.js";import"./useMutation.esm.3aac1ad5.js";import"./mutation.esm.54ea4acf.js";const v=()=>u("/entregas","listar-entrega"),nr=l({__name:"CrearEntrega",setup(R){const o=g({id:"",url_documento:null,fecha_entrega:null,estado:!0,documento_id:0,estudiante_id:""}),{createResource:i,isLoadingCreate:a,errorServer:m}=v(),n=r=>{i(r)},p=[{label:"Entregas",icon:"assignment_turned_in",to:"listar-entrega"},{label:"Registrar entrega",icon:"add_circle_outline"}];return(r,h)=>(_(),f(s,{padding:""},{default:C(()=>[t(d,{pages:p,titlePage:"Registrar entrega de documento"}),t(c,{entrega:o.value,loading:e(a),errorServer:e(m),onGuardar:n},null,8,["entrega","loading","errorServer"])]),_:1}))}});export{nr as default};
