(self.webpackChunk=self.webpackChunk||[]).push([[951,271,834],{5271:(e,t,o)=>{"use strict";o.r(t),o.d(t,{default:()=>s});var r=o(5166),n=(0,r.withScopeId)("data-v-35f0511d");(0,r.pushScopeId)("data-v-35f0511d");var a={class:"header"},i={key:0,class:"footer"};(0,r.popScopeId)();var c=n((function(e,t,o,n,c,l){return(0,r.openBlock)(),(0,r.createBlock)("div",{class:["card",o.cardClass]},[(0,r.createVNode)("div",a,[(0,r.createVNode)("h1",null,(0,r.toDisplayString)(o.title),1)]),(0,r.createVNode)("div",{class:["body",o.bodyClass]},[(0,r.renderSlot)(e.$slots,"default",{},void 0,!0)],2),e.$slots.footer?((0,r.openBlock)(),(0,r.createBlock)("div",i,[(0,r.renderSlot)(e.$slots,"footer",{},void 0,!0)])):(0,r.createCommentVNode)("",!0)],2)}));const l={props:{title:String,bodyClass:String,cardClass:String},name:"Card",methods:{dd:function(e){console.log(e)}}};l.render=c,l.__scopeId="data-v-35f0511d";const s=l},7951:(e,t,o)=>{"use strict";o.r(t),o.d(t,{default:()=>I});var r=o(5166),n={key:0,class:"contact-success"},a=(0,r.createVNode)("p",null,"Thank you for your message.",-1),i=(0,r.createVNode)("p",null,"It will be processed as soon as possible.",-1),c=(0,r.createVNode)("i",{class:"far fa-envelope fa-5x"},null,-1),l={class:"form-row"},s=(0,r.createVNode)("label",{for:"name"}," Name ",-1),d={key:0},u={class:"form-row"},m=(0,r.createVNode)("label",{for:"subject"}," Subject ",-1),f={key:0},p={class:"form-row"},k=(0,r.createVNode)("label",{for:"message"},[(0,r.createTextVNode)(" Message "),(0,r.createVNode)("span",{class:"help"},"(Accepted: English & German)")],-1),h={key:0},g={class:"form-row"},b=(0,r.createVNode)("label",{for:"email"}," Email Address ",-1),V={key:0},N={class:"form-row"},B=(0,r.createVNode)("label",{for:"email_confirmation"}," Confirm Email Address ",-1),v={key:0},C={class:"confirmations"},y=(0,r.createVNode)("label",{for:"confirmation"},"Confirm privacy policy",-1),w={class:"submit-row"},x={class:"ping-container"},S={key:0,class:"ping-1"},T=(0,r.createVNode)("span",{class:"ping-2"},null,-1),E=(0,r.createVNode)("span",{class:"ping-3"},null,-1);var D=o(9834),j=o(5271);const M={layout:D.default,name:"Index",props:{links:Object,subject:String,name:String,message:String,email:String,email_confirmation:String,confirmation:Boolean},components:{Card:j.default},data:function(){return{confirmed:!0,sending:!1,disabled:!0,sent:!1,submitErrors:[]}},methods:{submit:_.debounce((function(){var e=this;this.sending=!0,this.disabled=!0,axios.post(route("contact.store"),{_token:this._token,subject:this.subject,name:this.name,message:this.message,email:this.email,email_confirmation:this.email_confirmation,confirmation:this.confirmation}).then((function(t){e.sent=!0})).catch((function(t){t.response&&422===t.response.status?(e.sending=!1,e.submitErrors=t.response.data.errors):window.confirm("An unknown error has occurred. Please try again at another time")&&(e.sending=!1)}))}),10),isDisabled:function(){return this.mailConfirmed(),this.sending?this.disabled=!0:this.subject&&this.message&&this.email&&this.email_confirmation&&this.confirmed?this.disabled=!1:this.disabled=!0},mailConfirmed:function(){var e=this.email,t=this.email_confirmation;if(!t||!e)return this.confirmed=!0;var o=e.trim(),r=t.trim();return this.confirmed=o===r}},render:function(e,t,o,_,D,j){var M=(0,r.resolveComponent)("card");return(0,r.openBlock)(),(0,r.createBlock)("form",{onInput:t[9]||(t[9]=function(e){return j.isDisabled()}),onSubmit:t[10]||(t[10]=(0,r.withModifiers)((function(){return j.submit&&j.submit.apply(j,arguments)}),["prevent"]))},[(0,r.createVNode)(M,{title:"Contact",bodyClass:"form-body",cardClass:"w-120"},(0,r.createSlots)({default:(0,r.withCtx)((function(){return[e.sent?((0,r.openBlock)(),(0,r.createBlock)("div",n,[a,i,c])):(0,r.createCommentVNode)("",!0),e.sent?(0,r.createCommentVNode)("",!0):((0,r.openBlock)(),(0,r.createBlock)(r.Fragment,{key:1},[(0,r.createVNode)("div",l,[s,(0,r.withDirectives)((0,r.createVNode)("input",{id:"name",type:"text",placeholder:"Name","onUpdate:modelValue":t[1]||(t[1]=function(e){return o.name=e}),maxlength:"50",required:""},null,512),[[r.vModelText,o.name]]),e.submitErrors.name?((0,r.openBlock)(),(0,r.createBlock)("ul",d,[((0,r.openBlock)(!0),(0,r.createBlock)(r.Fragment,null,(0,r.renderList)(e.submitErrors.name,(function(e){return(0,r.openBlock)(),(0,r.createBlock)("li",null,(0,r.toDisplayString)(e),1)})),256))])):(0,r.createCommentVNode)("",!0)]),(0,r.createVNode)("div",u,[m,(0,r.withDirectives)((0,r.createVNode)("input",{id:"subject",type:"text",placeholder:"Subject","onUpdate:modelValue":t[2]||(t[2]=function(e){return o.subject=e}),maxlength:"50",required:""},null,512),[[r.vModelText,o.subject]]),e.submitErrors.subject?((0,r.openBlock)(),(0,r.createBlock)("ul",f,[((0,r.openBlock)(!0),(0,r.createBlock)(r.Fragment,null,(0,r.renderList)(e.submitErrors.subject,(function(e){return(0,r.openBlock)(),(0,r.createBlock)("li",null,(0,r.toDisplayString)(e),1)})),256))])):(0,r.createCommentVNode)("",!0)]),(0,r.createVNode)("div",p,[k,(0,r.withDirectives)((0,r.createVNode)("textarea",{id:"message","onUpdate:modelValue":t[3]||(t[3]=function(e){return o.message=e}),placeholder:"Message in English or German",required:""},null,512),[[r.vModelText,o.message]]),e.submitErrors.message?((0,r.openBlock)(),(0,r.createBlock)("ul",h,[((0,r.openBlock)(!0),(0,r.createBlock)(r.Fragment,null,(0,r.renderList)(e.submitErrors.message,(function(e){return(0,r.openBlock)(),(0,r.createBlock)("li",null,(0,r.toDisplayString)(e),1)})),256))])):(0,r.createCommentVNode)("",!0)]),(0,r.createVNode)("div",g,[b,(0,r.withDirectives)((0,r.createVNode)("input",{id:"email",type:"email",placeholder:"Email Address",autocomplete:"email","onUpdate:modelValue":t[4]||(t[4]=function(e){return o.email=e}),onKeyup:t[5]||(t[5]=function(e){return j.mailConfirmed()}),required:""},null,544),[[r.vModelText,o.email]]),e.submitErrors.email?((0,r.openBlock)(),(0,r.createBlock)("ul",V,[((0,r.openBlock)(!0),(0,r.createBlock)(r.Fragment,null,(0,r.renderList)(e.submitErrors.email,(function(e){return(0,r.openBlock)(),(0,r.createBlock)("li",null,(0,r.toDisplayString)(e),1)})),256))])):(0,r.createCommentVNode)("",!0)]),(0,r.createVNode)("div",N,[B,(0,r.withDirectives)((0,r.createVNode)("input",{id:"email_confirmation",type:"text",placeholder:"Confirm Email Address","onUpdate:modelValue":t[6]||(t[6]=function(e){return o.email_confirmation=e}),onKeyup:t[7]||(t[7]=function(e){return j.mailConfirmed()}),required:""},null,544),[[r.vModelText,o.email_confirmation]]),e.confirmed?(0,r.createCommentVNode)("",!0):((0,r.openBlock)(),(0,r.createBlock)("p",v,"The Email addresses entered do not match."))])],64))]})),_:2},[e.sent?void 0:{name:"footer",fn:(0,r.withCtx)((function(){return[(0,r.createVNode)("div",C,[y,(0,r.withDirectives)((0,r.createVNode)("input",{id:"confirmation",type:"checkbox","onUpdate:modelValue":t[8]||(t[8]=function(e){return o.confirmation=e})},null,512),[[r.vModelCheckbox,o.confirmation]])]),(0,r.createVNode)("div",w,[(0,r.createVNode)("span",x,[(0,r.createVNode)("button",{type:"submit",disabled:e.disabled}," Send Message ",8,["disabled"]),e.sending?((0,r.openBlock)(),(0,r.createBlock)("span",S,[T,E])):(0,r.createCommentVNode)("",!0)])])]}))}]),1024)],32)}},I=M},9834:(e,t,o)=>{"use strict";o.r(t),o.d(t,{default:()=>x});var r=o(5166),n={id:"sidebar-draw"},a={key:0},i=(0,r.createVNode)("i",{class:"fas fa-times menu-switch"},null,-1),c={key:1},l=(0,r.createVNode)("i",{class:"fas fa-bars menu-switch"},null,-1),s=(0,r.createVNode)("span",{class:"sr-only"},"Menü",-1),d={role:"navigation"},u={id:"bottom"},m={key:0},f=(0,r.createTextVNode)(" Administration "),p={key:1},k=(0,r.createVNode)("i",{class:"fab fa-github fa-fw"},null,-1),h=(0,r.createTextVNode)(" Login with GitHub "),g={key:0,id:"github-edit"},b=(0,r.createVNode)("i",{class:"fa-fw fab fa-github"},null,-1),V=(0,r.createTextVNode)(" Edit [ "),N=(0,r.createTextVNode)(),B=(0,r.createTextVNode)(" | "),v=(0,r.createTextVNode)(),C=(0,r.createTextVNode)(" ] ");var y=o(9680);const w={props:{metaTitle:String,gitController:String,gitComponent:String},data:function(){return{open:!1,dimmer:!0,menuItems:[{name:"Links",route:"home"},{name:"Contact",route:"contact.index"}]}},methods:{toggle:function(){this.open=!this.open}},updated:function(){document.title=this.metaTitle},mounted:function(){var e=this;y.Inertia.on("navigate",(function(t){e.toggle()}))},render:function(e,t,o,y,w,x){var S=(0,r.resolveComponent)("inertia-link");return(0,r.openBlock)(),(0,r.createBlock)(r.Fragment,null,[(0,r.createVNode)("div",{id:"sidebar",class:{"z-40":w.open}},[(0,r.createVNode)("div",n,[(0,r.createVNode)("button",{onClick:t[1]||(t[1]=(0,r.withModifiers)((function(e){return x.toggle()}),["prevent"])),id:"sidebar-button",class:"transition-color"},[w.open?((0,r.openBlock)(),(0,r.createBlock)("span",a,[i])):((0,r.openBlock)(),(0,r.createBlock)("span",c,[l])),s]),(0,r.createVNode)("div",{id:"sidebar-content",class:[w.open?"max-w-lg border-r border-gray-500":"max-w-0"]},[(0,r.createVNode)("nav",d,[(0,r.createVNode)("ul",null,[((0,r.openBlock)(!0),(0,r.createBlock)(r.Fragment,null,(0,r.renderList)(w.menuItems,(function(t,o){return(0,r.openBlock)(),(0,r.createBlock)("li",{key:o},[e.route().current(t.route)?((0,r.openBlock)(),(0,r.createBlock)(S,{key:0,href:e.route(t.route),"aria-current":"page"},{default:(0,r.withCtx)((function(){return[(0,r.createTextVNode)((0,r.toDisplayString)(t.name),1)]})),_:2},1032,["href"])):((0,r.openBlock)(),(0,r.createBlock)(S,{key:1,href:e.route(t.route)},{default:(0,r.withCtx)((function(){return[(0,r.createTextVNode)((0,r.toDisplayString)(t.name),1)]})),_:2},1032,["href"]))])})),128))])]),(0,r.createVNode)("nav",null,[(0,r.createVNode)("ul",u,[this.authed?((0,r.openBlock)(),(0,r.createBlock)("li",m,[(0,r.createVNode)(S,{href:"/settings"},{default:(0,r.withCtx)((function(){return[f]})),_:1})])):((0,r.openBlock)(),(0,r.createBlock)("li",p,[(0,r.createVNode)(S,{href:e.route("auth","github")},{default:(0,r.withCtx)((function(){return[k,h]})),_:1},8,["href"])]))])])],2)]),(0,r.createVNode)(r.Transition,{name:"fade"},{default:(0,r.withCtx)((function(){return[w.dimmer&&w.open?((0,r.openBlock)(),(0,r.createBlock)("div",{key:0,onClick:t[2]||(t[2]=function(e){return x.toggle()}),id:"sidebar-fade",class:"active:outline-none"})):(0,r.createCommentVNode)("",!0)]})),_:1})],2),(0,r.createVNode)("main",null,[(0,r.renderSlot)(e.$slots,"default")]),o.gitController||o.gitComponent?((0,r.openBlock)(),(0,r.createBlock)("div",g,[b,V,o.gitComponent?((0,r.openBlock)(),(0,r.createBlock)("a",{key:0,href:o.gitComponent,target:"_blank"},"Component",8,["href"])):(0,r.createCommentVNode)("",!0),N,o.gitController&&o.gitComponent?((0,r.openBlock)(),(0,r.createBlock)(r.Fragment,{key:1},[B],64)):(0,r.createCommentVNode)("",!0),v,o.gitController?((0,r.openBlock)(),(0,r.createBlock)("a",{key:2,href:o.gitController,target:"_blank"},"Controller",8,["href"])):(0,r.createCommentVNode)("",!0),C])):(0,r.createCommentVNode)("",!0)],64)}},x=w}}]);