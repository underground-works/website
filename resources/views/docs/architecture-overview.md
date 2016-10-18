# Architecture overview

This document provides a quick overview of the Clockwork architecture.

Clockwork consists of two components:

- browser extension (Clockwork client) - responsible for presenting the collected data to the user
- server-side component - responsible for collecting the data and providing it to the clients

## Browser extension

The browser extension checks HTTP responses for the `X-Clockwork-Version` and `X-Clockwork-Id` headers. The `X-Clockwork-Version` header contains the version of the server-side component, while the header is required, the content is not important and is used only for statistic purposes. More important is the `X-Clockwork-Id` which contains the unique identifier for the current HTTP request.

Once a request containing both of these headers is received, Clockwork retrieves the request metadata via a HTTP GET request to `/__clockwork/{ID}`. The metadata endpoint URI can be overridden via a `X-Clockwork-Path` header, if present, the request ID will be appended to the end of the header value. This endpoint should return the request metadata in the [Clockwork metadata format](/docs/metadata-specification).

## Server-side library

The Clockwork server-side library consists of several components:

- DataSources - objects responsible for the metadata collection itself
- Request - data objects for storing the metadata
- Storage - objects responsible for persisting and retrieving the metadata
- Support - various supporting files for frameworks and libraries, like service providers, middleware, etc.

Check out the [extending Clockwork page](/docs/extending-clockwork) for information on writing your own data sources and storage implementations.

Typical request lifecycle looks like this:

- *new request is received by the application*
- main Clockwork class is instantiated, this automatically creates new Request instance as well
- one or more data sources are added to the Clockwork instance via `$clockwork->addDataSource` calls
- a storage class is instantiated and set on the Clockwork instance via `$clockwork->setStorage` call
- *application runs*
- `$clockwork->resolveRequest` is called, causing Request object to pass through `resolve` method on all configured data sources, each adding relevant data to the Request instance
- `$clockwork->storeRequest` is called, persisting the Request object via set storage implementation
- `X-Clockwork-Version` and `X-Clockwork-Id` headers are set on the response
