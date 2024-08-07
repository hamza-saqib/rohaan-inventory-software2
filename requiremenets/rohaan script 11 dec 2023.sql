if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[Table1]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[Table1]
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[grnrec]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[grnrec]
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[icitem]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[icitem]
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[invrec]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[invrec]
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[issueloc]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[issueloc]
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[itemcat]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[itemcat]
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[logininfo]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[logininfo]
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[oldissue]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[oldissue]
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[oldrec]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[oldrec]
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[supplierrec]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[supplierrec]
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[tb1]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[tb1]
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[uomind]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[uomind]
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[usrdb]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[usrdb]
GO

CREATE TABLE [dbo].[Table1] (
	[1- User ID] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[Passwd] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[grnrec] (
	[vn] [numeric](18, 0) NULL ,
	[vd] [datetime] NULL ,
	[gn] [numeric](18, 0) NULL ,
	[gd] [datetime] NULL ,
	[sc] [numeric](18, 0) NULL ,
	[sin] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[sid] [datetime] NULL ,
	[ved] [numeric](19, 4) NULL ,
	[st] [numeric](19, 4) NULL ,
	[sed] [numeric](19, 4) NULL ,
	[fed] [numeric](19, 4) NULL ,
	[od] [numeric](19, 4) NULL ,
	[nv] [numeric](19, 4) NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[icitem] (
	[code] [numeric](18, 0) NULL ,
	[name1] [char] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[uom] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[catcode] [numeric](18, 0) NULL ,
	[loct] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[misc_code] [numeric](18, 0) NULL ,
	[tax_rate] [numeric](18, 0) NULL ,
	[remarks] [char] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[invrec] (
	[vn] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[vd] [datetime] NULL ,
	[gn] [int] NULL ,
	[gd] [datetime] NULL ,
	[sc] [int] NULL ,
	[sin] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[sid] [datetime] NULL ,
	[ic] [int] NULL ,
	[qty] [decimal](19, 2) NULL ,
	[rat] [decimal](19, 2) NULL ,
	[ved] [decimal](19, 2) NULL ,
	[st] [decimal](19, 2) NULL ,
	[sed] [decimal](19, 2) NULL ,
	[fed] [decimal](19, 2) NULL ,
	[od] [decimal](19, 2) NULL ,
	[nv] [decimal](19, 2) NULL ,
	[remarks] [char] (300) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[trnln] [decimal](19, 2) NULL ,
	[id_col] [int] IDENTITY (1, 1) NOT NULL ,
	[fy] [char] (4) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[ugn] [int] NULL ,
	[ttype] [char] (1) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[issueloc] (
	[code1] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[name1] [char] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[remarks] [char] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[itemcat] (
	[code] [numeric](18, 0) NOT NULL ,
	[name1] [char] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[factor] [numeric](18, 0) NULL ,
	[remarks] [char] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[logininfo] (
	[user ID - Char] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[passwd] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[oldissue] (
	[isno] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[isdt] [datetime] NULL ,
	[dpt] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[ic] [int] NULL ,
	[Qty] [decimal](19, 4) NULL ,
	[Irate] [decimal](19, 4) NULL ,
	[Iamt] [decimal](19, 4) NULL ,
	[remarks] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[id_col] [int] IDENTITY (1, 1) NOT NULL ,
	[fy] [char] (4) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[oldrec] (
	[vn] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[vd] [datetime] NULL ,
	[gn] [int] NULL ,
	[gd] [datetime] NULL ,
	[sc] [int] NULL ,
	[sin] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[sid] [datetime] NULL ,
	[ic] [int] NULL ,
	[qty] [decimal](19, 4) NULL ,
	[rat] [decimal](19, 4) NULL ,
	[ved] [decimal](19, 4) NULL ,
	[st] [decimal](19, 4) NULL ,
	[sed] [decimal](19, 4) NULL ,
	[fed] [decimal](19, 4) NULL ,
	[od] [decimal](19, 4) NULL ,
	[nv] [decimal](19, 4) NULL ,
	[remarks] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[trnln] [decimal](19, 4) NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[supplierrec] (
	[code] [numeric](18, 0) NOT NULL ,
	[name1] [char] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[address] [char] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[phone1] [char] (15) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[phone2] [char] (15) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[faxno] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[ntn] [char] (20) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[stn] [char] (40) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[remarks] [char] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[tb1] (
	[vn] [int] NULL ,
	[vdd] [datetime] NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[uomind] (
	[code] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[descrip] [char] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[factor] [int] NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[usrdb] (
	[usid] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[paswrd] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

