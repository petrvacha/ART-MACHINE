<?php

/**
 * This file is part of the Nette Framework (http://nette.org)
 *
 * Copyright (c) 2004, 2011 David Grudl (http://davidgrudl.com)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 * @package Nette\Loaders
 */



/**
 * Nette auto loader is responsible for loading Nette classes and interfaces.
 *
 * @author     David Grudl
 */
class NNetteLoader extends NAutoLoader
{
	/** @var NNetteLoader */
	private static $instance;

	/** @var array */
	public $list = array(
		'argumentoutofrangeexception' => '/tools/exceptions.php',
		'datetime53' => '/tools/DateTime53.php',
		'deprecatedexception' => '/tools/exceptions.php',
		'directorynotfoundexception' => '/tools/exceptions.php',
		'fatalerrorexception' => '/tools/exceptions.php',
		'filenotfoundexception' => '/tools/exceptions.php',
		'iannotation' => '/Reflection/IAnnotation.php',
		'iauthenticator' => '/Security/IAuthenticator.php',
		'iauthorizator' => '/Security/IAuthorizator.php',
		'icachejournal' => '/Caching/ICacheJournal.php',
		'icachestorage' => '/Caching/ICacheStorage.php',
		'icomponent' => '/ComponentModel/IComponent.php',
		'icomponentcontainer' => '/ComponentModel/IComponentContainer.php',
		'iconfigadapter' => '/Config/IConfigAdapter.php',
		'icontext' => '/Injection/IContext.php',
		'idebugpanel' => '/Diagnostics/IDebugPanel.php',
		'ifiletemplate' => '/Templates/IFileTemplate.php',
		'iformcontrol' => '/Forms/IFormControl.php',
		'iformrenderer' => '/Forms/IFormRenderer.php',
		'ifreezable' => '/tools/IFreezable.php',
		'ihttprequest' => '/Http/IHttpRequest.php',
		'ihttpresponse' => '/Http/IHttpResponse.php',
		'iidentity' => '/Security/IIdentity.php',
		'imailer' => '/Mail/IMailer.php',
		'invalidstateexception' => '/tools/exceptions.php',
		'ioexception' => '/tools/exceptions.php',
		'ipartiallyrenderable' => '/Application/IPartiallyRenderable.php',
		'ipresenter' => '/Application/IPresenter.php',
		'ipresenterfactory' => '/Application/IPresenterFactory.php',
		'ipresenterresponse' => '/Application/IPresenterResponse.php',
		'irenderable' => '/Application/IRenderable.php',
		'iresource' => '/Security/IResource.php',
		'irole' => '/Security/IRole.php',
		'irouter' => '/Application/IRouter.php',
		'isessionstorage' => '/Http/ISessionStorage.php',
		'isignalreceiver' => '/Application/ISignalReceiver.php',
		'istatepersistent' => '/Application/IStatePersistent.php',
		'isubmittercontrol' => '/Forms/ISubmitterControl.php',
		'isupplementaldriver' => '/Database/ISupplementalDriver.php',
		'itemplate' => '/Templates/ITemplate.php',
		'itranslator' => '/Localization/ITranslator.php',
		'iuser' => '/Http/IUser.php',
		'memberaccessexception' => '/tools/exceptions.php',
		'nabortexception' => '/Application/exceptions/AbortException.php',
		'nambiguousserviceexception' => '/Injection/AmbiguousServiceException.php',
		'nannotation' => '/Reflection/Annotation.php',
		'nannotationsparser' => '/Reflection/AnnotationsParser.php',
		'nappform' => '/Application/AppForm.php',
		'napplication' => '/Application/Application.php',
		'napplicationexception' => '/Application/exceptions/ApplicationException.php',
		'narrayhash' => '/tools/ArrayHash.php',
		'narraylist' => '/tools/ArrayList.php',
		'narraytools' => '/tools/ArrayTools.php',
		'nauthenticationexception' => '/Security/AuthenticationException.php',
		'nautoloader' => '/Loaders/AutoLoader.php',
		'nbadrequestexception' => '/Application/exceptions/BadRequestException.php',
		'nbadsignalexception' => '/Application/exceptions/BadSignalException.php',
		'nbutton' => '/Forms/Controls/Button.php',
		'ncache' => '/Caching/Cache.php',
		'ncachinghelper' => '/Latte/CachingHelper.php',
		'ncallback' => '/tools/Callback.php',
		'ncallbackfilteriterator' => '/tools/iterators/CallbackFilterIterator.php',
		'ncheckbox' => '/Forms/Controls/Checkbox.php',
		'nclassreflection' => '/Reflection/ClassReflection.php',
		'nclirouter' => '/Application/Routers/CliRouter.php',
		'nclosurefix' => '/tools/Framework.php',
		'ncomponent' => '/ComponentModel/Component.php',
		'ncomponentcontainer' => '/ComponentModel/ComponentContainer.php',
		'nconfig' => '/Config/Config.php',
		'nconfigadapterini' => '/Config/ConfigAdapterIni.php',
		'nconfigadapterneon' => '/Config/ConfigAdapterNeon.php',
		'nconfigurator' => '/Environment/Configurator.php',
		'nconnection' => '/Database/Connection.php',
		'ncontext' => '/Injection/Context.php',
		'ncontrol' => '/Application/Control.php',
		'ndatabasepanel' => '/Database/Diagnostics/DatabasePanel.php',
		'ndatabasereflection' => '/Database/Reflection/DatabaseReflection.php',
		'ndebug' => '/Diagnostics/Debug.php',
		'ndebughelpers' => '/Diagnostics/DebugHelpers.php',
		'ndebugpanel' => '/Diagnostics/DebugPanel.php',
		'ndefaultformrenderer' => '/Forms/Renderers/DefaultFormRenderer.php',
		'ndownloadresponse' => '/Application/Responses/DownloadResponse.php',
		'ndummystorage' => '/Caching/DummyStorage.php',
		'nenvironment' => '/Environment/Environment.php',
		'nextensionreflection' => '/Reflection/ExtensionReflection.php',
		'nfilejournal' => '/Caching/FileJournal.php',
		'nfilestorage' => '/Caching/FileStorage.php',
		'nfiletemplate' => '/Templates/FileTemplate.php',
		'nfileupload' => '/Forms/Controls/FileUpload.php',
		'nfinder' => '/tools/Finder.php',
		'nforbiddenrequestexception' => '/Application/exceptions/ForbiddenRequestException.php',
		'nform' => '/Forms/Form.php',
		'nformcontainer' => '/Forms/FormContainer.php',
		'nformcontrol' => '/Forms/Controls/FormControl.php',
		'nformgroup' => '/Forms/FormGroup.php',
		'nforwardingresponse' => '/Application/Responses/ForwardingResponse.php',
		'nframework' => '/tools/Framework.php',
		'nfreezableobject' => '/tools/FreezableObject.php',
		'nfunctionreflection' => '/Reflection/FunctionReflection.php',
		'ngenericrecursiveiterator' => '/tools/iterators/GenericRecursiveIterator.php',
		'ngroupedtableselection' => '/Database/Selector/GroupedTableSelection.php',
		'nhiddenfield' => '/Forms/Controls/HiddenField.php',
		'nhtml' => '/tools/Html.php',
		'nhttpcontext' => '/Http/HttpContext.php',
		'nhttprequest' => '/Http/HttpRequest.php',
		'nhttprequestfactory' => '/Http/HttpRequestFactory.php',
		'nhttpresponse' => '/Http/HttpResponse.php',
		'nhttpuploadedfile' => '/Http/HttpUploadedFile.php',
		'nidentity' => '/Security/Identity.php',
		'nimage' => '/tools/Image.php',
		'nimagebutton' => '/Forms/Controls/ImageButton.php',
		'ninstancefilteriterator' => '/tools/iterators/InstanceFilterIterator.php',
		'ninvalidlinkexception' => '/Application/exceptions/InvalidLinkException.php',
		'ninvalidpresenterexception' => '/Application/exceptions/InvalidPresenterException.php',
		'njson' => '/tools/Json.php',
		'njsonexception' => '/tools/JsonException.php',
		'njsonresponse' => '/Application/Responses/JsonResponse.php',
		'nlatteexception' => '/Latte/LatteException.php',
		'nlattefilter' => '/Latte/LatteFilter.php',
		'nlattemacros' => '/Latte/LatteMacros.php',
		'nlimitedscope' => '/Loaders/LimitedScope.php',
		'nlink' => '/Application/Link.php',
		'nmail' => '/Mail/Mail.php',
		'nmailmimepart' => '/Mail/MailMimePart.php',
		'nmapiterator' => '/tools/iterators/MapIterator.php',
		'nmemcachedstorage' => '/Caching/MemcachedStorage.php',
		'nmemorystorage' => '/Caching/MemoryStorage.php',
		'nmethodreflection' => '/Reflection/MethodReflection.php',
		'nmultirouter' => '/Application/Routers/MultiRouter.php',
		'nmultiselectbox' => '/Forms/Controls/MultiSelectBox.php',
		'nneon' => '/tools/Neon.php',
		'nneonexception' => '/tools/Neon.php',
		'nnetteloader' => '/Loaders/NetteLoader.php',
		'nobject' => '/tools/Object.php',
		'nobjectmixin' => '/tools/ObjectMixin.php',
		'notimplementedexception' => '/tools/exceptions.php',
		'notsupportedexception' => '/tools/exceptions.php',
		'npaginator' => '/tools/Paginator.php',
		'nparameterreflection' => '/Reflection/ParameterReflection.php',
		'npdomssqldriver' => '/Database/Drivers/PdoMsSqlDriver.php',
		'npdomysqldriver' => '/Database/Drivers/PdoMySqlDriver.php',
		'npdoocidriver' => '/Database/Drivers/PdoOciDriver.php',
		'npdoodbcdriver' => '/Database/Drivers/PdoOdbcDriver.php',
		'npdopgsqldriver' => '/Database/Drivers/PdoPgSqlDriver.php',
		'npdosqlite2driver' => '/Database/Drivers/PdoSqlite2Driver.php',
		'npdosqlitedriver' => '/Database/Drivers/PdoSqliteDriver.php',
		'npermission' => '/Security/Permission.php',
		'npresenter' => '/Application/Presenter.php',
		'npresentercomponent' => '/Application/PresenterComponent.php',
		'npresentercomponentreflection' => '/Application/PresenterComponentReflection.php',
		'npresenterfactory' => '/Application/PresenterFactory.php',
		'npresenterrequest' => '/Application/PresenterRequest.php',
		'npropertyreflection' => '/Reflection/PropertyReflection.php',
		'nradiolist' => '/Forms/Controls/RadioList.php',
		'nrecursivecallbackfilteriterator' => '/tools/iterators/RecursiveCallbackFilterIterator.php',
		'nrecursivecomponentiterator' => '/ComponentModel/RecursiveComponentIterator.php',
		'nredirectingresponse' => '/Application/Responses/RedirectingResponse.php',
		'nregexpexception' => '/tools/RegexpException.php',
		'nrenderresponse' => '/Application/Responses/RenderResponse.php',
		'nrobotloader' => '/Loaders/RobotLoader.php',
		'nroute' => '/Application/Routers/Route.php',
		'nroutingdebugger' => '/Application/Diagnostics/RoutingDebugger.php',
		'nrow' => '/Database/Row.php',
		'nrule' => '/Forms/Rule.php',
		'nrules' => '/Forms/Rules.php',
		'nsafestream' => '/tools/SafeStream.php',
		'nselectbox' => '/Forms/Controls/SelectBox.php',
		'nsendmailmailer' => '/Mail/SendmailMailer.php',
		'nsession' => '/Http/Session.php',
		'nsessionnamespace' => '/Http/SessionNamespace.php',
		'nsimpleauthenticator' => '/Security/SimpleAuthenticator.php',
		'nsimplerouter' => '/Application/Routers/SimpleRouter.php',
		'nsmartcachingiterator' => '/tools/iterators/SmartCachingIterator.php',
		'nsmtpexception' => '/Mail/SmtpException.php',
		'nsmtpmailer' => '/Mail/SmtpMailer.php',
		'nsqlliteral' => '/Database/SqlLiteral.php',
		'nsqlpreprocessor' => '/Database/SqlPreprocessor.php',
		'nstatement' => '/Database/Statement.php',
		'nstring' => '/tools/String.php',
		'nsubmitbutton' => '/Forms/Controls/SubmitButton.php',
		'ntablerow' => '/Database/Selector/TableRow.php',
		'ntableselection' => '/Database/Selector/TableSelection.php',
		'ntemplate' => '/Templates/Template.php',
		'ntemplatecachestorage' => '/Templates/TemplateCacheStorage.php',
		'ntemplateexception' => '/Templates/TemplateException.php',
		'ntemplatefilters' => '/Templates/TemplateFilters.php',
		'ntemplatehelpers' => '/Templates/TemplateHelpers.php',
		'ntextarea' => '/Forms/Controls/TextArea.php',
		'ntextbase' => '/Forms/Controls/TextBase.php',
		'ntextinput' => '/Forms/Controls/TextInput.php',
		'ntokenizer' => '/tools/Tokenizer.php',
		'ntokenizerexception' => '/tools/TokenizerException.php',
		'ntools' => '/tools/Tools.php',
		'nuri' => '/Http/Uri.php',
		'nuriscript' => '/Http/UriScript.php',
		'nuser' => '/Http/User.php',
	);



	/**
	 * Returns singleton instance with lazy instantiation.
	 * @return NNetteLoader
	 */
	public static function getInstance()
	{
		if (self::$instance === NULL) {
			self::$instance = new self;
		}
		return self::$instance;
	}



	/**
	 * Handles autoloading of classes or interfaces.
	 * @param  string
	 * @return void
	 */
	public function tryLoad($type)
	{
		$type = ltrim(strtolower($type), '\\');
		if (isset($this->list[$type])) {
			NLimitedScope::load(NETTE_DIR . $this->list[$type]);
			self::$count++;
		}
	}

}
