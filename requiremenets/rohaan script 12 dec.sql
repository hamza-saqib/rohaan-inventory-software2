CREATE TABLE [dtproperties] (
	[id] [int] IDENTITY (1, 1) NOT NULL ,
	[objectid] [int] NULL ,
	[property] [varchar] (64) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[value] [varchar] (255) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[uvalue] [nvarchar] (255) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[lvalue] [image] NULL ,
	[version] [int] NOT NULL CONSTRAINT [DF__dtpropert__versi__77BFCB91] DEFAULT (0),
	CONSTRAINT [pk_dtproperties] PRIMARY KEY  CLUSTERED
	(
		[id],
		[property]
	)  ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]








CREATE TABLE [grnrec] (
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








CREATE TABLE [icitem] (
	[code] [numeric](18, 0) NULL ,
	[name1] [char] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[uom] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[catcode] [numeric](18, 0) NULL ,
	[loct] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[misc_code] [numeric](18, 0) NULL ,
	[tax_rate] [numeric](18, 0) NULL ,
	[remarks] [char] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL
) ON [PRIMARY]








CREATE TABLE [invrec] (
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
	[ttype] [char] (1) COLLATE SQL_Latin1_General_CP1_CI_AS NULL CONSTRAINT [DF_invrec_ttype] DEFAULT ('')
) ON [PRIMARY]







CREATE TABLE [issueloc] (
	[code1] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[name1] [char] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[remarks] [char] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL
) ON [PRIMARY]








CREATE TABLE [itemcat] (
	[code] [numeric](18, 0) NOT NULL ,
	[name1] [char] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[factor] [numeric](18, 0) NULL ,
	[remarks] [char] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	CONSTRAINT [PK_Table1] PRIMARY KEY  CLUSTERED
	(
		[code]
	)  ON [PRIMARY]
) ON [PRIMARY]








CREATE TABLE [logininfo] (
	[user ID - Char] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[passwd] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL
) ON [PRIMARY]









CREATE TABLE [oldissue] (
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









CREATE TABLE [oldrec] (
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









CREATE TABLE [supplierrec] (
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









CREATE TABLE [syscolumns] (
	[name] [sysname] NOT NULL ,
	[id] [int] NOT NULL ,
	[xtype] [tinyint] NOT NULL ,
	[typestat] [tinyint] NOT NULL ,
	[xusertype] [smallint] NOT NULL ,
	[length] [smallint] NOT NULL ,
	[xprec] [tinyint] NOT NULL ,
	[xscale] [tinyint] NOT NULL ,
	[colid] [smallint] NOT NULL ,
	[xoffset] [smallint] NOT NULL ,
	[bitpos] [tinyint] NOT NULL ,
	[reserved] [tinyint] NOT NULL ,
	[colstat] [smallint] NOT NULL ,
	[cdefault] [int] NOT NULL ,
	[domain] [int] NOT NULL ,
	[number] [smallint] NOT NULL ,
	[colorder] [smallint] NOT NULL ,
	[autoval] [varbinary] (8000) NULL ,
	[offset] [smallint] NOT NULL ,
	[collationid] [int] NULL ,
	[language] [int] NOT NULL ,
	[status] AS (convert(tinyint,(([bitpos] & 7) + case when ([typestat] & 1 = 0) then 8 else 0 end + case when (([typestat] & 2 <> 0 or (type_name([xtype]) = 'image' or type_name([xtype]) = 'text') and [colstat] & 0x1000 <> 0)) then 16 else 0 end + case when (((type_name([xtype]) = 'image' or type_name([xtype]) = 'text') and [colstat] & 0x2000 <> 0 or (type_name([xtype]) = 'timestamp' or (type_name([xtype]) = 'char' or type_name([xtype]) = 'binary')) and [typestat] & 1 = 0)) then 32 else 0 end + case when ([colstat] & 4 <> 0) then 64 else 0 end + case when ([colstat] & 1 <> 0) then 128 else 0 end))) ,
	[type] AS (convert(tinyint,xtypetotds([xtype],(1 - ([typestat] & 1))))) ,
	[usertype] AS (convert(smallint,columnproperty([id],[name],'oldusertype'))) ,
	[printfmt] AS (convert(varchar(255),[autoval])) ,
	[prec] AS (convert(smallint,case when ((type_name([xtype]) = 'ntext' or (type_name([xtype]) = 'image' or type_name([xtype]) = 'text'))) then null when (type_name([xtype]) = 'uniqueidentifier') then [xprec] else (odbcprec([xtype],[length],[xprec])) end)) ,
	[scale] AS (odbcscale([xtype],[xscale])) ,
	[iscomputed] AS (convert(int,sign(([colstat] & 4)))) ,
	[isoutparam] AS (convert(int,sign(([colstat] & 4)))) ,
	[isnullable] AS (convert(int,(1 - ([typestat] & 1)))) ,
	[collation] AS (convert(sysname,collationpropertyfromid([collationid],'name'))) ,
	[tdscollation] AS (convert(binary(5),collationpropertyfromid([collationid],'tdscollation')))
) ON [PRIMARY]









CREATE TABLE [syscomments] (
	[id] [int] NOT NULL ,
	[number] [smallint] NOT NULL ,
	[colid] [smallint] NOT NULL ,
	[status] [smallint] NOT NULL ,
	[ctext] [varbinary] (8000) NOT NULL ,
	[texttype] AS (convert(smallint,(2 + 4 * ([status] & 1)))) ,
	[language] AS (convert(smallint,0)) ,
	[encrypted] AS (convert(bit,([status] & 1))) ,
	[compressed] AS (convert(bit,([status] & 2))) ,
	[text] AS (convert(nvarchar(4000),case when ([status] & 2 = 2) then (uncompress([ctext])) else [ctext] end))
) ON [PRIMARY]









CREATE TABLE [sysdepends] (
	[id] [int] NOT NULL ,
	[depid] [int] NOT NULL ,
	[number] [smallint] NOT NULL ,
	[depnumber] [smallint] NOT NULL ,
	[status] [smallint] NOT NULL ,
	[deptype] [tinyint] NOT NULL ,
	[depdbid] AS (convert(smallint,0)) ,
	[depsiteid] AS (convert(smallint,0)) ,
	[selall] AS (convert(bit,([status] & 2))) ,
	[resultobj] AS (convert(bit,([status] & 4))) ,
	[readobj] AS (convert(bit,([status] & 8)))
) ON [PRIMARY]










CREATE TABLE [sysfilegroups] (
	[groupid] [smallint] NOT NULL ,
	[allocpolicy] [smallint] NOT NULL ,
	[status] [int] NOT NULL ,
	[groupname] [sysname] NOT NULL
) ON [PRIMARY]









CREATE TABLE [sysfiles] (
	[fileid] [smallint] NOT NULL ,
	[groupid] [smallint] NOT NULL ,
	[size] [int] NOT NULL ,
	[maxsize] [int] NOT NULL ,
	[growth] [int] NOT NULL ,
	[status] [int] NOT NULL ,
	[perf] [int] NOT NULL ,
	[name] [nchar] (128) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[filename] [nchar] (260) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL
)







CREATE TABLE [sysfiles1] (
	[status] [int] NOT NULL ,
	[fileid] [smallint] NOT NULL ,
	[name] [nchar] (128) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[filename] [nchar] (260) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL
) ON [PRIMARY]









CREATE TABLE [sysforeignkeys] (
	[constid] [int] NOT NULL ,
	[fkeyid] [int] NOT NULL ,
	[rkeyid] [int] NOT NULL ,
	[fkey] [smallint] NOT NULL ,
	[rkey] [smallint] NOT NULL ,
	[keyno] [smallint] NOT NULL
)








CREATE TABLE [sysfulltextcatalogs] (
	[ftcatid] [smallint] NOT NULL ,
	[name] [sysname] NOT NULL ,
	[status] [smallint] NOT NULL ,
	[path] [nvarchar] (260) COLLATE SQL_Latin1_General_CP1_CI_AS NULL
) ON [PRIMARY]









CREATE TABLE [sysfulltextnotify] (
	[tableid] [int] NOT NULL ,
	[rowinfo] [smallint] NOT NULL ,
	[ftkey] [varbinary] (896) NOT NULL
) ON [PRIMARY]









CREATE TABLE [sysindexes] (
	[id] [int] NOT NULL ,
	[status] [int] NOT NULL ,
	[first] [binary] (6) NOT NULL ,
	[indid] [smallint] NOT NULL ,
	[root] [binary] (6) NOT NULL ,
	[minlen] [smallint] NOT NULL ,
	[keycnt] [smallint] NOT NULL ,
	[groupid] [smallint] NOT NULL ,
	[dpages] [int] NOT NULL ,
	[reserved] [int] NOT NULL ,
	[used] [int] NOT NULL ,
	[rowcnt] [bigint] NOT NULL ,
	[rowmodctr] [int] NOT NULL ,
	[reserved3] [tinyint] NOT NULL ,
	[reserved4] [tinyint] NOT NULL ,
	[xmaxlen] [smallint] NOT NULL ,
	[maxirow] [smallint] NOT NULL ,
	[OrigFillFactor] [tinyint] NOT NULL ,
	[StatVersion] [tinyint] NOT NULL ,
	[reserved2] [int] NOT NULL ,
	[FirstIAM] [binary] (6) NOT NULL ,
	[impid] [smallint] NOT NULL ,
	[lockflags] [smallint] NOT NULL ,
	[pgmodctr] [int] NOT NULL ,
	[keys] [varbinary] (1088) NULL ,
	[name] [sysname] NOT NULL ,
	[statblob] [image] NULL ,
	[maxlen] AS (8000) ,
	[rows] AS (case when ([rowcnt] > 2147483647) then 2147483647 else (convert(int,[rowcnt])) end)
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]








CREATE TABLE [sysindexkeys] (
	[id] [int] NOT NULL ,
	[indid] [smallint] NOT NULL ,
	[colid] [smallint] NOT NULL ,
	[keyno] [smallint] NOT NULL
)







CREATE TABLE [sysmembers] (
	[memberuid] [smallint] NOT NULL ,
	[groupuid] [smallint] NOT NULL
)








CREATE TABLE [sysobjects] (
	[name] [sysname] NOT NULL ,
	[id] [int] NOT NULL ,
	[xtype] [char] (2) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[uid] [smallint] NOT NULL ,
	[info] [smallint] NOT NULL ,
	[status] [int] NOT NULL ,
	[base_schema_ver] [int] NOT NULL ,
	[replinfo] [int] NOT NULL ,
	[parent_obj] [int] NOT NULL ,
	[crdate] [datetime] NOT NULL ,
	[ftcatid] [smallint] NOT NULL ,
	[schema_ver] AS ([base_schema_ver] & ((~15))) ,
	[stats_schema_ver] AS ([base_schema_ver] & 15) ,
	[type] AS (convert(char(2),case when (([xtype] = 'UQ' or [xtype] = 'PK')) then 'K' else [xtype] end)) ,
	[userstat] AS (convert(smallint,case when (([xtype] = 'S' or [xtype] = 'U')) then 1 else 0 end)) ,
	[sysstat] AS (convert(smallint,(case [xtype] when 'S' then 1 when 'V' then 2 when 'U' then 3 when 'P' then 4 when 'RF' then 4 when 'X' then 4 when 'L' then 5 when 'D' then 6 when 'R' then 7 when 'TR' then 8 when 'PK' then 9 when 'UQ' then 9 when 'C' then 10 when 'F' then 11 when 'AP' then 13 else 0 end + case when (([xtype] = 'S' or [xtype] = 'U')) then (case when ([status] & 1 <> 0) then 16 else 0 end + case when ([status] & 2 <> 0) then 32 else 0 end + 64 + case when (substring([name],1,1) = '#') then 256 else 0 end + case when ([status] & 0x01000000 <> 0) then 512 else 0 end + case when ([status] & 0x200000 <> 0) then 1024 else 0 end + case when ([status] & 0x04000000 <> 0) then 2048 else 0 end + case when ([status] & 4 <> 0) then 8192 else 0 end + case when (substring([name],1,2) = '##') then (-32768) else 0 end) else 0 end))) ,
	[indexdel] AS (convert(smallint,(([base_schema_ver] & ((~15))) / 65536))) ,
	[refdate] AS (convert(datetime,[crdate])) ,
	[version] AS (convert(int,0)) ,
	[deltrig] AS (convert(int,case when (([xtype] = 'S' or [xtype] = 'U')) then (objectproperty([id],'TableDeleteTrigger')) when ([xtype] = 'TR') then [parent_obj] else 0 end)) ,
	[instrig] AS (convert(int,case when (([xtype] = 'S' or [xtype] = 'U')) then (objectproperty([id],'TableInsertTrigger')) else 0 end)) ,
	[updtrig] AS (convert(int,case when (([xtype] = 'S' or [xtype] = 'U')) then (objectproperty([id],'TableUpdateTrigger')) else 0 end)) ,
	[seltrig] AS (convert(int,0)) ,
	[category] AS (convert(int,(case when ([status] & 0x80000000 <> 0) then 2 else 0 end + case when ([replinfo] & 1 <> 0) then 32 else 0 end + case when ([replinfo] & 2 <> 0) then 64 else 0 end + case when ([replinfo] & 4 <> 0) then 256 else 0 end + case when ([xtype] = 'P' and ([status] & 2 <> 0)) then 16 else 0 end + case when ([xtype] = 'D' and ([parent_obj] <> 0)) then 2048 else 0 end + case when (([xtype] = 'S' or [xtype] = 'U')) then (case when ([status] & 0x20 <> 0) then 1 else 0 end + case when ([status] & 0x0400 <> 0) then 4 else 0 end + case when ([status] & 0x0800 <> 0) then 8 else 0 end + case when ([status] & 0x1000 <> 0) then 128 else 0 end + case when ([status] & 0x0100 <> 0) then 512 else 0 end + case when ([status] & 0x0200 <> 0) then 1024 else 0 end + case when ([status] & 0x2000 <> 0) then 2048 else 0 end + case when ([status] & 0x4000 <> 0) then 4096 else 0 end + case when ([status] & 0x10 <> 0) then 16384 else 0 end) else 0 end))) ,
	[cache] AS (convert(smallint,0))
) ON [PRIMARY]








CREATE TABLE [syspermissions] (
	[id] [int] NOT NULL ,
	[grantee] [smallint] NOT NULL ,
	[grantor] [smallint] NOT NULL ,
	[actadd] [smallint] NOT NULL ,
	[actmod] [smallint] NOT NULL ,
	[seladd] [varbinary] (4000) NULL ,
	[selmod] [varbinary] (4000) NULL ,
	[updadd] [varbinary] (4000) NULL ,
	[updmod] [varbinary] (4000) NULL ,
	[refadd] [varbinary] (4000) NULL ,
	[refmod] [varbinary] (4000) NULL
) ON [PRIMARY]









CREATE TABLE [sysproperties] (
	[id] [int] NOT NULL ,
	[smallid] [smallint] NOT NULL ,
	[type] [tinyint] NOT NULL ,
	[name] [sysname] NOT NULL ,
	[value] [sql_variant] NULL
) ON [PRIMARY]








CREATE TABLE [sysprotects] (
	[id] [int] NOT NULL ,
	[uid] [smallint] NOT NULL ,
	[action] [tinyint] NOT NULL ,
	[protecttype] [tinyint] NOT NULL ,
	[columns] [varbinary] (4000) NULL ,
	[grantor] [smallint] NOT NULL
)








CREATE TABLE [sysreferences] (
	[constid] [int] NOT NULL ,
	[fkeyid] [int] NOT NULL ,
	[rkeyid] [int] NOT NULL ,
	[rkeyindid] [smallint] NOT NULL ,
	[keycnt] [smallint] NOT NULL ,
	[forkeys] [varbinary] (32) NOT NULL ,
	[refkeys] [varbinary] (32) NOT NULL ,
	[fkeydbid] AS (convert(smallint,0)) ,
	[rkeydbid] AS (convert(smallint,0)) ,
	[fkey1] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([forkeys],1,2))),0))) ,
	[fkey2] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([forkeys],3,2))),0))) ,
	[fkey3] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([forkeys],5,2))),0))) ,
	[fkey4] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([forkeys],7,2))),0))) ,
	[fkey5] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([forkeys],9,2))),0))) ,
	[fkey6] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([forkeys],11,2))),0))) ,
	[fkey7] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([forkeys],13,2))),0))) ,
	[fkey8] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([forkeys],15,2))),0))) ,
	[fkey9] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([forkeys],17,2))),0))) ,
	[fkey10] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([forkeys],19,2))),0))) ,
	[fkey11] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([forkeys],21,2))),0))) ,
	[fkey12] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([forkeys],23,2))),0))) ,
	[fkey13] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([forkeys],25,2))),0))) ,
	[fkey14] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([forkeys],27,2))),0))) ,
	[fkey15] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([forkeys],29,2))),0))) ,
	[fkey16] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([forkeys],31,2))),0))) ,
	[rkey1] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([refkeys],1,2))),0))) ,
	[rkey2] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([refkeys],3,2))),0))) ,
	[rkey3] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([refkeys],5,2))),0))) ,
	[rkey4] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([refkeys],7,2))),0))) ,
	[rkey5] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([refkeys],9,2))),0))) ,
	[rkey6] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([refkeys],11,2))),0))) ,
	[rkey7] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([refkeys],13,2))),0))) ,
	[rkey8] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([refkeys],15,2))),0))) ,
	[rkey9] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([refkeys],17,2))),0))) ,
	[rkey10] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([refkeys],19,2))),0))) ,
	[rkey11] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([refkeys],21,2))),0))) ,
	[rkey12] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([refkeys],23,2))),0))) ,
	[rkey13] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([refkeys],25,2))),0))) ,
	[rkey14] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([refkeys],27,2))),0))) ,
	[rkey15] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([refkeys],29,2))),0))) ,
	[rkey16] AS (convert(smallint,isnull(convert(binary(2),reverse(substring([refkeys],31,2))),0)))
) ON [PRIMARY]









CREATE TABLE [systypes] (
	[name] [sysname] NOT NULL ,
	[xtype] [tinyint] NOT NULL ,
	[status] [tinyint] NOT NULL ,
	[xusertype] [smallint] NOT NULL ,
	[length] [smallint] NOT NULL ,
	[xprec] [tinyint] NOT NULL ,
	[xscale] [tinyint] NOT NULL ,
	[tdefault] [int] NOT NULL ,
	[domain] [int] NOT NULL ,
	[uid] [smallint] NOT NULL ,
	[reserved] [smallint] NOT NULL ,
	[collationid] [int] NULL ,
	[usertype] AS (convert(smallint,typeproperty([name],'oldusertype'))) ,
	[variable] AS (convert(bit,case when ((type_name([xtype]) = 'nvarchar' or (type_name([xtype]) = 'varchar' or type_name([xtype]) = 'varbinary'))) then 1 else 0 end)) ,
	[allownulls] AS (convert(bit,(1 - ([status] & 1)))) ,
	[type] AS (convert(tinyint,xtypetotds([xtype],0))) ,
	[printfmt] AS (convert(varchar(255),null)) ,
	[prec] AS (convert(smallint,case when ((type_name([xtype]) = 'ntext' or (type_name([xtype]) = 'image' or type_name([xtype]) = 'text'))) then null else (typeproperty([name],'precision')) end)) ,
	[scale] AS (convert(tinyint,typeproperty([name],'scale'))) ,
	[collation] AS (convert(sysname,collationpropertyfromid([collationid],'name')))
) ON [PRIMARY]









CREATE TABLE [sysusers] (
	[uid] [smallint] NOT NULL ,
	[status] [smallint] NOT NULL ,
	[name] [sysname] NOT NULL ,
	[sid] [varbinary] (85) NULL ,
	[roles] [varbinary] (2048) NOT NULL ,
	[createdate] [datetime] NOT NULL ,
	[updatedate] [datetime] NOT NULL ,
	[altuid] [smallint] NOT NULL ,
	[password] [varbinary] (256) NULL ,
	[gid] AS (convert(smallint,case when ([uid] >= 16400) then [uid] when ((datalength([roles]) is null or datalength([roles]) <= 2)) then 0 else (16384 - 8 + datalength([roles]) * 8 + case when (convert(tinyint,[roles]) & 1 <> 0) then 0 when (convert(tinyint,[roles]) & 2 <> 0) then 1 when (convert(tinyint,[roles]) & 4 <> 0) then 2 when (convert(tinyint,[roles]) & 8 <> 0) then 3 when (convert(tinyint,[roles]) & 16 <> 0) then 4 when (convert(tinyint,[roles]) & 32 <> 0) then 5 when (convert(tinyint,[roles]) & 64 <> 0) then 6 when (convert(tinyint,[roles]) & 128 <> 0) then 7 end) end)) ,
	[environ] AS (convert(varchar(255),null)) ,
	[hasdbaccess] AS (convert(int,case when ([status] & 2 = 2) then 1 else 0 end)) ,
	[islogin] AS (convert(int,case when ([status] & 32 = 0 and [uid] > 0 and ([uid] < 16384)) then 1 else 0 end)) ,
	[isntname] AS (convert(int,case when ([status] & 4 = 4) then 1 else 0 end)) ,
	[isntgroup] AS (convert(int,case when ([status] & 12 = 4) then 1 else 0 end)) ,
	[isntuser] AS (convert(int,case when ([status] & 12 = 12) then 1 else 0 end)) ,
	[issqluser] AS (convert(int,case when ([status] & 60 = 0 and [uid] > 0 and ([uid] < 16384)) then 1 else 0 end)) ,
	[isaliased] AS (convert(int,case when ([status] & 16 = 16) then 1 else 0 end)) ,
	[issqlrole] AS (convert(int,case when (([uid] >= 16384 or [uid] = 0)) then 1 else 0 end)) ,
	[isapprole] AS (convert(int,case when ([status] & 32 = 32) then 1 else 0 end))
) ON [PRIMARY]








CREATE TABLE [Table1] (
	[1- User ID] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[Passwd] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL
) ON [PRIMARY]








CREATE TABLE [tb1] (
	[vn] [int] NULL ,
	[vdd] [datetime] NULL
) ON [PRIMARY]








CREATE TABLE [uomind] (
	[code] [char] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[descrip] [char] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[factor] [int] NULL
) ON [PRIMARY]









CREATE TABLE [usrdb] (
	[usid] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[paswrd] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL
) ON [PRIMARY]



