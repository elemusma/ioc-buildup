window.yoast=window.yoast||{},window.yoast.analysisReport=function(t){var e={};function s(r){if(e[r])return e[r].exports;var a=e[r]={i:r,l:!1,exports:{}};return t[r].call(a.exports,a,a.exports,s),a.l=!0,a.exports}return s.m=t,s.c=e,s.d=function(t,e,r){s.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:r})},s.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},s.t=function(t,e){if(1&e&&(t=s(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(s.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var a in t)s.d(r,a,function(e){return t[e]}.bind(null,a));return r},s.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return s.d(e,"a",e),e},s.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},s.p="",s(s.s=379)}({0:function(t,e){t.exports=window.yoast.propTypes},1:function(t,e){t.exports=window.wp.element},2:function(t,e){t.exports=window.lodash},3:function(t,e){t.exports=window.React},379:function(t,e,s){"use strict";s.r(e),s.d(e,"ContentAnalysis",(function(){return _})),s.d(e,"AnalysisResult",(function(){return y})),s.d(e,"AnalysisList",(function(){return E})),s.d(e,"renderRatingToColor",(function(){return R})),s.d(e,"SiteSEOReport",(function(){return S}));var r=s(1),a=s(4),o=s(3),n=s.n(o),i=s(5),l=s.n(i),u=s(0),c=s.n(u),d=s(85),m=s.n(d),p=s(6),g=s(2),b=s(8);const k=l.a.li`
	// This is the height of the IconButtonToggle.
	min-height: 24px;
	padding: 0;
	display: flex;
	align-items: flex-start;
`,B=l()(b.SvgIcon)`
	margin: 3px 11px 0 0; // icon 13 + 11 right margin = 24 for the 8px grid.
`,h=l.a.p`
	margin: 0 16px 0 0;
	flex: 1 1 auto;
	color: ${t=>t.suppressedText?"rgba(30,30,30,0.5)":"inherit"};
`,f=t=>{let{ariaLabel:e,id:s,className:a,status:o,onClick:n,isPressed:i}=t;return Object(r.createElement)(b.IconButtonToggle,{marksButtonStatus:o,className:a,onClick:n,id:s,icon:"eye",pressed:i,ariaLabel:e})},C=t=>{let{markButtonFactory:e,...s}=t;e=e||f;const{id:a,marker:n,hasMarksButton:i}=s;let l=null;return function(t){return!t.hasMarksButton||"hidden"===t.marksButtonStatus}(s)||(l=e({onClick:s.onButtonClickMarks,status:s.marksButtonStatus,className:s.marksButtonClassName,id:s.buttonIdMarks,isPressed:s.pressed,ariaLabel:s.ariaLabelMarks})),Object(o.useEffect)(()=>{s.onResultChange(a,n,i)},[a,n,i]),Object(r.createElement)(k,null,Object(r.createElement)(B,{icon:"circle",color:s.bulletColor,size:"13px"}),Object(r.createElement)(h,{suppressedText:s.suppressedText},s.hasBetaBadgeLabel&&Object(r.createElement)(b.BetaBadge,null),Object(r.createElement)("span",{dangerouslySetInnerHTML:{__html:s.text}})),l,s.hasEditButton&&s.isPremium&&Object(r.createElement)(b.IconCTAEditButton,{className:s.editButtonClassName,onClick:s.onButtonClickEdit,id:s.buttonIdEdit,icon:"edit",ariaLabel:s.ariaLabelEdit}))};C.propTypes={text:c.a.string.isRequired,suppressedText:c.a.bool,bulletColor:c.a.string.isRequired,hasMarksButton:c.a.bool.isRequired,hasEditButton:c.a.bool,buttonIdMarks:c.a.string.isRequired,buttonIdEdit:c.a.string,pressed:c.a.bool.isRequired,ariaLabelMarks:c.a.string.isRequired,ariaLabelEdit:c.a.string,onButtonClickMarks:c.a.func.isRequired,onButtonClickEdit:c.a.func,marksButtonStatus:c.a.string,marksButtonClassName:c.a.string,markButtonFactory:c.a.func,editButtonClassName:c.a.string,hasBetaBadgeLabel:c.a.bool,isPremium:c.a.bool,onResultChange:c.a.func,id:c.a.string,marker:c.a.oneOfType([c.a.func,c.a.array])},C.defaultProps={suppressedText:!1,marksButtonStatus:"enabled",marksButtonClassName:"",editButtonClassName:"",hasBetaBadgeLabel:!1,hasEditButton:!1,buttonIdEdit:"",ariaLabelEdit:"",onButtonClickEdit:g.noop,isPremium:!1,onResultChange:g.noop,id:"",marker:g.noop};var y=C;const x=l.a.ul`
	margin: 8px 0;
	padding: 0;
	list-style: none;
`;function R(t){switch(t){case"good":return p.colors.$color_good;case"OK":return p.colors.$color_ok;case"bad":return p.colors.$color_bad;default:return p.colors.$color_score_icon}}function E(t){return Object(r.createElement)(x,{role:"list"},t.results.map(e=>{const s=R(e.rating),o=e.markerId===t.marksButtonActivatedResult,n=e.id+"Mark",i=e.id+"Edit";let l="";l="disabled"===t.marksButtonStatus?Object(a.__)("Marks are disabled in current view","wordpress-seo"):o?Object(a.__)("Remove highlight from the text","wordpress-seo"):Object(a.__)("Highlight this result in the text","wordpress-seo");const u=e.editFieldName,c=""===u?"":Object(a.sprintf)(
/* Translators: %1$s refers to the name of the field that should be edited (keyphrase, meta description,
       slug or SEO title). */
Object(a.__)("Edit your %1$s","wordpress-seo"),u);return Object(r.createElement)(y,{key:e.id,id:e.id,text:e.text,marker:e.marker,bulletColor:s,hasMarksButton:e.hasMarks,hasEditButton:e.hasJumps,ariaLabelMarks:l,ariaLabelEdit:c,pressed:o,suppressedText:"upsell"===e.rating,buttonIdMarks:n,buttonIdEdit:i,onButtonClickMarks:()=>t.onMarksButtonClick(e.id,e.marker),onButtonClickEdit:()=>t.onEditButtonClick(e.id),marksButtonClassName:t.marksButtonClassName,editButtonClassName:t.editButtonClassName,marksButtonStatus:t.marksButtonStatus,hasBetaBadgeLabel:e.hasBetaBadge,isPremium:t.isPremium,onResultChange:t.onResultChange,markButtonFactory:t.markButtonFactory})}))}E.propTypes={results:c.a.array.isRequired,marksButtonActivatedResult:c.a.string,marksButtonStatus:c.a.string,marksButtonClassName:c.a.string,editButtonClassName:c.a.string,markButtonFactory:c.a.func,onMarksButtonClick:c.a.func,onEditButtonClick:c.a.func,isPremium:c.a.bool,onResultChange:c.a.func},E.defaultProps={marksButtonActivatedResult:"",marksButtonStatus:"enabled",marksButtonClassName:"",editButtonClassName:"",onMarksButtonClick:m.a,onEditButtonClick:m.a,isPremium:!1,onResultChange:m.a};const w=l.a.div`
	width: 100%;
	background-color: white;
	border-bottom: 1px solid transparent; // Avoid parent and child margin collapsing.
`,O=l()(b.Collapsible)`
	margin-bottom: 8px;

	button:first-child svg {
		margin: -2px 8px 0 -2px; // Compensate icon size set to 18px.
	}

	${b.StyledIconsButton} {
		padding: 8px 0;
		color: ${p.colors.$color_blue}
	}
`;class v extends n.a.Component{renderCollapsible(t,e,s){return Object(r.createElement)(O,{initialIsOpen:!0,title:`${t} (${s.length})`,prefixIcon:{icon:"angle-up",color:p.colors.$color_grey_dark,size:"18px"},prefixIconCollapsed:{icon:"angle-down",color:p.colors.$color_grey_dark,size:"18px"},suffixIcon:null,suffixIconCollapsed:null,headingProps:{level:e,fontSize:"13px",fontWeight:"bold"}},Object(r.createElement)(E,{results:s,marksButtonActivatedResult:this.props.activeMarker,marksButtonStatus:this.props.marksButtonStatus,marksButtonClassName:this.props.marksButtonClassName,editButtonClassName:this.props.editButtonClassName,markButtonFactory:this.props.markButtonFactory,onMarksButtonClick:this.props.onMarkButtonClick,onEditButtonClick:this.props.onEditButtonClick,isPremium:this.props.isPremium,onResultChange:this.props.onResultChange}))}render(){const{problemsResults:t,improvementsResults:e,goodResults:s,considerationsResults:o,errorsResults:n,upsellResults:i,headingLevel:l,resultCategoryLabels:u}=this.props,c=n.length,d=t.length,m=e.length,p=o.length,g=s.length,b=i.length,k={errors:Object(a.__)("Errors","wordpress-seo"),problems:Object(a.__)("Problems","wordpress-seo"),improvements:Object(a.__)("Improvements","wordpress-seo"),considerations:Object(a.__)("Considerations","wordpress-seo"),goodResults:Object(a.__)("Good results","wordpress-seo")},B=Object.assign(k,u);return Object(r.createElement)(w,null,c>0&&this.renderCollapsible(B.errors,l,n),d+b>0&&this.renderCollapsible(B.problems,l,[...i,...t]),m>0&&this.renderCollapsible(B.improvements,l,e),p>0&&this.renderCollapsible(B.considerations,l,o),g>0&&this.renderCollapsible(B.goodResults,l,s))}}v.propTypes={onMarkButtonClick:c.a.func,onEditButtonClick:c.a.func,problemsResults:c.a.array,improvementsResults:c.a.array,goodResults:c.a.array,considerationsResults:c.a.array,errorsResults:c.a.array,upsellResults:c.a.array,headingLevel:c.a.number,marksButtonStatus:c.a.string,marksButtonClassName:c.a.string,markButtonFactory:c.a.func,editButtonClassName:c.a.string,activeMarker:c.a.string,isPremium:c.a.bool,resultCategoryLabels:c.a.shape({errors:c.a.string,problems:c.a.string,improvements:c.a.string,considerations:c.a.string,goodResults:c.a.string}),onResultChange:c.a.func},v.defaultProps={onMarkButtonClick:()=>{},onEditButtonClick:()=>{},problemsResults:[],improvementsResults:[],goodResults:[],considerationsResults:[],errorsResults:[],upsellResults:[],headingLevel:4,marksButtonStatus:"enabled",marksButtonClassName:"",markButtonFactory:null,editButtonClassName:"",activeMarker:"",isPremium:!1,resultCategoryLabels:{},onResultChange:()=>{}};var _=v;const N=l.a.div`
`,j=l.a.p`
	font-size: 14px;
`,M=t=>Object(r.createElement)(N,{className:t.className},Object(r.createElement)(j,{className:t.className+"__text"},t.seoAssessmentText),Object(r.createElement)(b.StackedProgressBar,{className:"progress",items:t.seoAssessmentItems,barHeight:t.barHeight}),Object(r.createElement)(b.ScoreAssessments,{className:"assessments",items:t.seoAssessmentItems}));M.propTypes={className:c.a.string,seoAssessmentText:c.a.string,seoAssessmentItems:c.a.arrayOf(c.a.shape({html:c.a.string.isRequired,value:c.a.number.isRequired,color:c.a.string.isRequired})),barHeight:c.a.string},M.defaultProps={className:"seo-assessment",seoAssessmentText:"SEO Assessment",seoAssessmentItems:null,barHeight:"24px"};var S=M},4:function(t,e){t.exports=window.wp.i18n},5:function(t,e){t.exports=window.yoast.styledComponents},6:function(t,e){t.exports=window.yoast.styleGuide},8:function(t,e){t.exports=window.yoast.componentsNew},85:function(t,e){t.exports=window.lodash.noop}});